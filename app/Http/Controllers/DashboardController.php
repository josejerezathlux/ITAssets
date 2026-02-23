<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\DigitalAsset;
use App\Models\Employee;
use App\Models\MaintenanceLog;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        if (!auth()->user()->hasPermission('dashboard.view')) {
            abort(403);
        }

        $totalAssets = Asset::count();
        $assetsByCategory = AssetCategory::withCount('assets')->orderBy('name')->get();
        $assetsByStatus = Asset::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status');
        $unassignedCount = Asset::whereNull('assigned_employee_id')->count();

        $totalEmployees = Employee::count();
        $totalDepartments = Department::withCount('employees')->get();
        $totalRooms = Room::withCount('assets')->orderBy('name')->get();
        $totalCategories = AssetCategory::count();
        $totalUsers = User::count();
        $totalDigitalAssets = DigitalAsset::count();

        $now = Carbon::now();
        $warrantySoon = Asset::whereNotNull('warranty_expiry')
            ->whereBetween('warranty_expiry', [$now, $now->copy()->addDays(90)])
            ->orderBy('warranty_expiry')
            ->limit(15)
            ->get();
        $recentAssets = Asset::with('category')->orderByDesc('updated_at')->limit(10)->get();
        $maintenanceRecent = MaintenanceLog::with(['asset', 'performedBy'])->orderByDesc('date')->limit(10)->get();

        $unassignedAssets = Asset::whereNull('assigned_employee_id')
            ->with('category')
            ->orderBy('asset_tag')
            ->limit(8)
            ->get();

        $topEmployeesByAssets = Employee::withCount('assets')
            ->having('assets_count', '>', 0)
            ->orderByDesc('assets_count')
            ->with('department')
            ->limit(6)
            ->get();

        $chartCategories = $assetsByCategory->map(fn ($c) => [
            'id' => $c->id,
            'name' => $c->name,
            'count' => $c->assets_count,
        ])->values();
        $chartStatus = collect($assetsByStatus)->map(fn ($count, $status) => [
            'status' => $status,
            'label' => ucfirst(str_replace('_', ' ', $status)),
            'count' => $count,
        ])->values();
        $chartRooms = $totalRooms->take(10)->map(fn ($r) => [
            'id' => $r->id,
            'name' => $r->name,
            'count' => $r->assets_count,
        ])->values();

        return view('dashboard', compact(
            'totalAssets',
            'assetsByCategory',
            'assetsByStatus',
            'unassignedCount',
            'unassignedAssets',
            'totalEmployees',
            'totalDepartments',
            'totalRooms',
            'totalCategories',
            'totalUsers',
            'totalDigitalAssets',
            'warrantySoon',
            'recentAssets',
            'maintenanceRecent',
            'topEmployeesByAssets',
            'chartCategories',
            'chartStatus',
            'chartRooms'
        ));
    }
}
