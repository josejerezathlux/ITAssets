<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetCategory;
use App\Models\Employee;
use App\Models\MaintenanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    private function authorizeReports(): void
    {
        if (!auth()->user()->hasPermission('reports.view')) {
            abort(403);
        }
    }

    public function index(): View
    {
        $this->authorizeReports();
        return view('reports.index');
    }

    public function show(Request $request, string $type): View
    {
        $this->authorizeReports();
        $valid = ['summary', 'by-category', 'by-status', 'assigned', 'warranty', 'maintenance', 'employees-with-assets'];
        if (!in_array($type, $valid, true)) {
            abort(404);
        }

        $data = match ($type) {
            'summary' => $this->reportSummary(),
            'by-category' => $this->reportByCategory(),
            'by-status' => $this->reportByStatus(),
            'assigned' => $this->reportAssigned(),
            'warranty' => $this->reportWarranty(),
            'maintenance' => $this->reportMaintenance(),
            'employees-with-assets' => $this->reportEmployeesWithAssets(),
            default => [],
        };

        return view('reports.print', [
            'type' => $type,
            'title' => $this->reportTitle($type),
            'data' => $data,
            'generatedAt' => now()->format('F j, Y \a\t g:i A'),
        ]);
    }

    private function reportTitle(string $type): string
    {
        return match ($type) {
            'summary' => 'Asset Summary Report',
            'by-category' => 'Assets by Category',
            'by-status' => 'Assets by Status',
            'assigned' => 'Assigned Assets Report',
            'warranty' => 'Warranty Expiring (90 Days)',
            'maintenance' => 'Maintenance Summary',
            'employees-with-assets' => 'Employees with Assigned Assets',
            default => 'Report',
        };
    }

    private function reportSummary(): array
    {
        $total = Asset::count();
        $byStatus = Asset::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status')->all();
        $byCategory = AssetCategory::withCount('assets')->orderBy('name')->get();
        $assignedCount = Asset::whereNotNull('assigned_employee_id')->count();

        return [
            'total' => $total,
            'byStatus' => $byStatus,
            'byCategory' => $byCategory,
            'assignedCount' => $assignedCount,
        ];
    }

    private function reportByCategory(): array
    {
        $categories = AssetCategory::withCount('assets')->orderBy('name')->get();
        $items = Asset::with(['category', 'room', 'assignedEmployee'])
            ->orderBy('asset_category_id')
            ->orderBy('asset_tag')
            ->get()
            ->groupBy('asset_category_id');

        return ['categories' => $categories, 'items' => $items];
    }

    private function reportByStatus(): array
    {
        $statuses = ['in_use', 'in_stock', 'in_repair', 'retired', 'lost'];
        $items = Asset::with(['category', 'room', 'assignedEmployee'])
            ->orderBy('status')
            ->orderBy('asset_tag')
            ->get()
            ->groupBy('status');

        return ['statuses' => $statuses, 'items' => $items];
    }

    private function reportAssigned(): array
    {
        $assets = Asset::with(['category', 'assignedEmployee'])
            ->whereNotNull('assigned_employee_id')
            ->orderBy('asset_tag')
            ->get();

        return ['assets' => $assets];
    }

    private function reportWarranty(): array
    {
        $now = Carbon::now();
        $end = $now->copy()->addDays(90);
        $assets = Asset::with(['category', 'assignedEmployee'])
            ->whereNotNull('warranty_expiry')
            ->whereBetween('warranty_expiry', [$now, $end])
            ->orderBy('warranty_expiry')
            ->get();

        return ['assets' => $assets];
    }

    private function reportMaintenance(): array
    {
        $logs = MaintenanceLog::with(['asset', 'performedBy'])
            ->orderByDesc('date')
            ->limit(200)
            ->get();

        return ['logs' => $logs];
    }

    private function reportEmployeesWithAssets(): array
    {
        $employees = Employee::withCount('assets')->having('assets_count', '>', 0)->orderBy('name')->get();
        $details = [];
        foreach ($employees as $emp) {
            $details[] = [
                'employee' => $emp,
                'assets' => Asset::where('assigned_employee_id', $emp->id)->with('category')->orderBy('asset_tag')->get(),
            ];
        }

        return ['details' => $details];
    }
}
