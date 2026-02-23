<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDigitalAssetRequest;
use App\Http\Requests\UpdateDigitalAssetRequest;
use App\Models\DigitalAsset;
use App\Models\DigitalAssetAssignment;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DigitalAssetController extends Controller
{
    public function expiring(): View
    {
        $this->authorize('viewAny', DigitalAsset::class);
        $now = now();
        $items = DigitalAsset::query()
            ->withCount('assignments')
            ->where(function ($q) {
                $q->whereNotNull('end_date')->orWhereNotNull('renewal_date');
            })
            ->orderByRaw('COALESCE(end_date, renewal_date) ASC')
            ->get()
            ->map(function (DigitalAsset $asset) use ($now) {
                $expiryDate = $asset->end_date ?? $asset->renewal_date;
                $startDate = $asset->start_date ?? $asset->created_at;
                $totalDays = max(1, $startDate->diffInDays($expiryDate));
                $daysLeft = (int) $now->diffInDays($expiryDate, false);
                $rawElapsed = $startDate->diffInDays($now, false);
                $elapsedDays = (int) max(0, min($totalDays, $rawElapsed));
                $elapsedPct = round(100 * ($elapsedDays / $totalDays), 1);
                $remainingPct = round(100 - $elapsedPct, 1);
                if ($expiryDate->isPast()) {
                    $status = 'expired';
                } elseif ($daysLeft <= 30) {
                    $status = 'critical';
                } elseif ($daysLeft <= 90) {
                    $status = 'warning';
                } else {
                    $status = 'ok';
                }
                return (object) [
                    'asset' => $asset,
                    'expiry_date' => $expiryDate,
                    'days_left' => $daysLeft,
                    'elapsed_pct' => $elapsedPct,
                    'remaining_pct' => $remainingPct,
                    'status' => $status,
                ];
            });
        return view('digital-assets.expiring', compact('items'));
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', DigitalAsset::class);
        $query = DigitalAsset::query()->withCount('assignments');
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('vendor')) {
            $query->where('vendor', 'like', '%' . $request->vendor . '%');
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $digitalAssets = $query->orderBy('name')->paginate(20)->withQueryString();
        return view('digital-assets.index', compact('digitalAssets'));
    }

    public function create(): View
    {
        $this->authorize('create', DigitalAsset::class);
        return view('digital-assets.create');
    }

    public function store(StoreDigitalAssetRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['auto_renew'] = $request->boolean('auto_renew');
        DigitalAsset::create($data);
        return redirect()->route('digital-assets.index')->with('success', 'Digital asset added.');
    }

    public function show(DigitalAsset $digitalAsset): View
    {
        $this->authorize('view', $digitalAsset);
        $digitalAsset->loadCount('assignments');
        $digitalAsset->load(['assignments' => fn ($q) => $q->with('assignable')]);
        $assignedEmployeeIds = $digitalAsset->assignments()
            ->where('assignable_type', Employee::class)
            ->pluck('assignable_id');
        $employees = Employee::with('department')
            ->whereNotIn('id', $assignedEmployeeIds)
            ->orderBy('name')
            ->get();
        return view('digital-assets.show', compact('digitalAsset', 'employees'));
    }

    public function assign(Request $request, DigitalAsset $digitalAsset): RedirectResponse
    {
        $this->authorize('assign', $digitalAsset);
        $request->validate(['employee_id' => 'required|exists:employees,id']);
        $assignedIds = $digitalAsset->assignments()
            ->where('assignable_type', Employee::class)
            ->pluck('assignable_id');
        if ($assignedIds->contains($request->employee_id)) {
            return redirect()->route('digital-assets.show', $digitalAsset)
                ->with('error', 'That employee already has a seat.');
        }
        if ($digitalAsset->assignments()->count() >= $digitalAsset->quantity) {
            return redirect()->route('digital-assets.show', $digitalAsset)
                ->with('error', 'No seats available.');
        }
        $digitalAsset->assignments()->create([
            'assignable_type' => Employee::class,
            'assignable_id' => $request->employee_id,
            'assigned_at' => now(),
        ]);
        return redirect()->route('digital-assets.show', $digitalAsset)
            ->with('success', 'Employee assigned a seat.');
    }

    public function unassign(DigitalAsset $digitalAsset, DigitalAssetAssignment $assignment): RedirectResponse
    {
        $this->authorize('assign', $digitalAsset);
        if ($assignment->digital_asset_id !== $digitalAsset->id) {
            abort(404);
        }
        $assignment->delete();
        return redirect()->route('digital-assets.show', $digitalAsset)
            ->with('success', 'Seat unassigned.');
    }

    public function edit(DigitalAsset $digitalAsset): View
    {
        $this->authorize('update', $digitalAsset);
        return view('digital-assets.edit', compact('digitalAsset'));
    }

    public function update(UpdateDigitalAssetRequest $request, DigitalAsset $digitalAsset): RedirectResponse
    {
        $data = $request->validated();
        $data['auto_renew'] = $request->boolean('auto_renew');
        $digitalAsset->update($data);
        return redirect()->route('digital-assets.show', $digitalAsset)->with('success', 'Digital asset updated.');
    }

    public function destroy(DigitalAsset $digitalAsset): RedirectResponse
    {
        $this->authorize('delete', $digitalAsset);
        $digitalAsset->delete();
        return redirect()->route('digital-assets.index')->with('success', 'Digital asset removed.');
    }
}
