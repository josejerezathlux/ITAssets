<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Employee;
use App\Models\Room;
use App\Models\Attachment;
use App\Repositories\Contracts\AssetRepositoryInterface;
use App\Services\AssetService;
use App\Services\MaintenanceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssetController extends Controller
{
    public function __construct(
        protected AssetRepositoryInterface $assets,
        protected AssetService $assetService,
        protected MaintenanceService $maintenanceService,
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Asset::class);
        $filters = $request->only(['category_id', 'status', 'room_id', 'assigned', 'search']);
        $assets = $this->assets->paginateWithFilters($filters, 25);
        $categories = AssetCategory::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();

        return view('assets.index', compact('assets', 'filters', 'categories', 'rooms'));
    }

    public function create(): View
    {
        $this->authorize('create', Asset::class);
        $categories = AssetCategory::with('fields')->orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();

        $categoryFieldsForJs = [];
        foreach ($categories as $c) {
            $categoryFieldsForJs[$c->id] = $c->fields->map(function ($f) {
                return [
                    'id' => $f->id,
                    'name' => $f->name,
                    'key' => $f->key,
                    'input_type' => $f->input_type,
                    'options' => $f->options,
                    'value' => old('dynamic_fields.'.$f->id),
                ];
            })->values()->all();
        }

        return view('assets.create', compact('categories', 'rooms', 'employees', 'categoryFieldsForJs'));
    }

    public function store(StoreAssetRequest $request): RedirectResponse
    {
        $asset = $this->assetService->createAsset(
            $request->safe()->except('dynamic_fields'),
            $request->input('dynamic_fields', []),
            $request->user()
        );

        return redirect()->route('assets.show', $asset)->with('success', 'Asset created successfully.');
    }

    public function show(Asset $asset): View
    {
        $this->authorize('view', $asset);
        $asset = $this->assets->find($asset->id) ?? $asset->load([
            'category.fields', 'fields.field', 'room', 'assignedEmployee.department',
            'attachments', 'maintenanceLogs.performedBy', 'activityLogs.user', 'assignments.employee',
        ]);

        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset): View
    {
        $this->authorize('update', $asset);
        $asset->load('fields.field');
        $categories = AssetCategory::with('fields')->orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();

        return view('assets.edit', compact('asset', 'categories', 'rooms', 'employees'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset): RedirectResponse
    {
        $this->assetService->updateAsset(
            $asset,
            $request->safe()->except('dynamic_fields'),
            $request->input('dynamic_fields', []),
            $request->user()
        );

        return redirect()->route('assets.show', $asset)->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset): RedirectResponse
    {
        $this->authorize('delete', $asset);
        $this->assets->delete($asset);

        return redirect()->route('assets.index')->with('success', 'Asset deleted.');
    }

    public function checkOut(Request $request, Asset $asset): RedirectResponse
    {
        if (!$request->user()->hasPermission('assets.assign')) {
            abort(403);
        }
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'notes' => 'nullable|string',
        ]);
        $employee = Employee::findOrFail($request->employee_id);
        $this->assetService->checkOut($asset, $employee, $request->user(), $request->notes);

        return back()->with('success', 'Asset checked out.');
    }

    public function checkIn(Request $request, Asset $asset): RedirectResponse
    {
        if (!$request->user()->hasPermission('assets.assign')) {
            abort(403);
        }
        $request->validate(['notes' => 'nullable|string']);
        $this->assetService->checkIn($asset, $request->user(), $request->notes);

        return back()->with('success', 'Asset checked in.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        if (!$request->user()->hasPermission('assets.bulk')) {
            abort(403);
        }
        $request->validate([
            'action' => 'required|in:assign,move,delete',
            'asset_ids' => 'required|array',
            'asset_ids.*' => 'exists:assets,id',
        ]);
        $ids = $request->input('asset_ids', []);

        if ($request->action === 'delete') {
            $this->authorize('delete', Asset::class);
            Asset::whereIn('id', $ids)->each(fn (Asset $a) => $this->assets->delete($a));
            return redirect()->route('assets.index')->with('success', count($ids) . ' asset(s) deleted.');
        }

        if ($request->action === 'move' && $request->room_id) {
            Asset::whereIn('id', $ids)->update(['room_id' => $request->room_id]);
            return redirect()->route('assets.index')->with('success', count($ids) . ' asset(s) moved.');
        }

        if ($request->action === 'assign' && $request->employee_id) {
            if (!$request->user()->hasPermission('assets.assign')) {
                abort(403);
            }
            $employee = Employee::findOrFail($request->employee_id);
            foreach (Asset::whereIn('id', $ids)->get() as $asset) {
                if ($request->user()->can('view', $asset)) {
                    $this->assetService->checkOut($asset, $employee, $request->user());
                }
            }
            return redirect()->route('assets.index')->with('success', count($ids) . ' asset(s) assigned.');
        }

        return back()->with('error', 'Invalid bulk action or missing parameters.');
    }

    public function downloadTemplate(Request $request)
    {
        if (!$request->user()->hasPermission('assets.import')) {
            abort(403);
        }
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="assets_import_template.csv"',
        ];
        return response()->stream(function () {
            $h = fopen('php://output', 'w');
            fputcsv($h, ['asset_tag', 'category_slug', 'serial_number', 'make', 'model', 'purchase_date', 'vendor', 'cost', 'warranty_expiry', 'status', 'condition', 'room_name', 'assigned_employee_name', 'notes']);
            fputcsv($h, ['TAG-001', 'computer', 'SN123', 'Dell', 'OptiPlex', '2024-01-15', 'Vendor Inc', '999.00', '2027-01-15', 'in_stock', 'Good', 'Office A', '', '']);
            fclose($h);
        }, 200, $headers);
    }

    public function importCsv(Request $request): RedirectResponse
    {
        if (!$request->user()->hasPermission('assets.import')) {
            abort(403);
        }
        $request->validate(['file' => 'required|file|mimes:csv,txt|max:2048']);
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);
        $created = 0;
        $errors = [];
        $categories = AssetCategory::all()->keyBy('slug');
        $rooms = Room::all()->keyBy('name');
        $employees = Employee::all()->keyBy('name');
        $rowNum = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;
            $data = array_combine($header ?: [], $row);
            if (!$data) {
                continue;
            }
            $tag = trim($data['asset_tag'] ?? '');
            if (!$tag) {
                continue;
            }
            if (Asset::withTrashed()->where('asset_tag', $tag)->exists()) {
                $errors[] = "Row {$rowNum}: Asset tag {$tag} already exists.";
                continue;
            }
            $slug = trim($data['category_slug'] ?? '');
            $category = $categories->get($slug);
            if (!$category) {
                $errors[] = "Row {$rowNum}: Unknown category slug '{$slug}'.";
                continue;
            }
            $room = isset($data['room_name']) ? $rooms->get(trim($data['room_name'])) : null;
            $emp = isset($data['assigned_employee_name']) ? $employees->get(trim($data['assigned_employee_name'])) : null;
            $status = trim($data['status'] ?? 'in_stock');
            if (!in_array($status, ['in_use', 'in_stock', 'in_repair', 'retired', 'lost'], true)) {
                $status = 'in_stock';
            }
            try {
                $this->assetService->createAsset([
                    'asset_tag' => $tag,
                    'asset_category_id' => $category->id,
                    'serial_number' => trim($data['serial_number'] ?? '') ?: null,
                    'make' => trim($data['make'] ?? '') ?: null,
                    'model' => trim($data['model'] ?? '') ?: null,
                    'purchase_date' => trim($data['purchase_date'] ?? '') ?: null,
                    'vendor' => trim($data['vendor'] ?? '') ?: null,
                    'cost' => isset($data['cost']) && $data['cost'] !== '' ? (float) $data['cost'] : null,
                    'warranty_expiry' => trim($data['warranty_expiry'] ?? '') ?: null,
                    'status' => $status,
                    'condition' => trim($data['condition'] ?? '') ?: null,
                    'room_id' => $room?->id,
                    'assigned_employee_id' => $emp?->id,
                    'notes' => trim($data['notes'] ?? '') ?: null,
                ], [], $request->user());
                $created++;
            } catch (\Throwable $e) {
                $errors[] = "Row {$rowNum}: " . $e->getMessage();
            }
        }
        fclose($handle);
        if ($created > 0) {
            $request->session()->flash('success', "Imported {$created} asset(s).");
        }
        if (!empty($errors)) {
            $request->session()->flash('error', implode(' ', array_slice($errors, 0, 5)) . (count($errors) > 5 ? ' ...' : ''));
        }
        return redirect()->route('assets.index');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        if (!$request->user()->hasPermission('assets.export')) {
            abort(403);
        }
        $filters = $request->only(['category_id', 'status', 'room_id', 'assigned', 'search']);
        $assets = $this->assets->paginateWithFilters($filters, 10000);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="assets.csv"',
        ];

        return response()->stream(function () use ($assets) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Asset Tag', 'Category', 'Serial Number', 'Make', 'Model',
                'Purchase Date', 'Vendor', 'Cost', 'Warranty Expiry', 'Status', 'Condition',
                'Room', 'Assigned To', 'Notes',
            ]);
            foreach ($assets as $asset) {
                fputcsv($handle, [
                    $asset->asset_tag,
                    $asset->category?->name,
                    $asset->serial_number,
                    $asset->make,
                    $asset->model,
                    $asset->purchase_date?->format('Y-m-d'),
                    $asset->vendor,
                    $asset->cost,
                    $asset->warranty_expiry?->format('Y-m-d'),
                    $asset->status,
                    $asset->condition,
                    $asset->room?->name,
                    $asset->assignedEmployee?->name,
                    $asset->notes,
                ]);
            }
            fclose($handle);
        }, 200, $headers);
    }

    public function storeMaintenance(Request $request, Asset $asset): RedirectResponse
    {
        if (!$request->user()->hasPermission('assets.maintenance')) {
            abort(403);
        }
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:repair,upgrade,inspection',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240',
        ]);
        $this->maintenanceService->create($asset, $request->only('date', 'type', 'notes'), $request->user(), $request->file('attachment'));

        return back()->with('success', 'Maintenance log added.');
    }

    public function storeAttachment(Request $request, Asset $asset): RedirectResponse
    {
        if (!$request->user()->hasPermission('assets.upload_attachment')) {
            abort(403);
        }
        $request->validate(['file' => 'required|file|max:10240']);
        $file = $request->file('file');
        $path = $file->store('attachments/' . $asset->id, 'public');
        Attachment::create([
            'asset_id' => $asset->id,
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => $request->user()->id,
        ]);
        app(\App\Services\ActivityLogger::class)->log($request->user(), 'attachment.uploaded', $asset, null, ['path' => $path]);

        return back()->with('success', 'File uploaded.');
    }

    public function destroyAttachment(Asset $asset, Attachment $attachment): RedirectResponse
    {
        if (!request()->user()->hasPermission('assets.delete_attachment')) {
            abort(403);
        }
        if ($attachment->asset_id !== $asset->id) {
            abort(404);
        }
        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();
        app(\App\Services\ActivityLogger::class)->log(request()->user(), 'attachment.deleted', $asset);

        return back()->with('success', 'Attachment removed.');
    }
}
