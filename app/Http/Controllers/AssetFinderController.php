<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AssetFinderController extends Controller
{
    private const CATEGORY_ICONS = [
        'computer' => 'bi-pc-display',
        'laptop' => 'bi-laptop',
        'monitor' => 'bi-display',
        'printer' => 'bi-printer',
        'tv' => 'bi-tv',
        'speaker' => 'bi-speaker',
        'networking' => 'bi-hdd-network',
        'phone' => 'bi-telephone',
        'tablet' => 'bi-tablet',
        'peripheral' => 'bi-keyboard',
    ];

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Asset::class);

        $search = $request->input('search', '');
        $roomId = $request->input('room_id', '');
        $status = $request->input('status', '');

        $query = Asset::with('category', 'room', 'assignedEmployee')
            ->whereNull('deleted_at');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('asset_tag', 'like', '%' . $search . '%')
                    ->orWhere('serial_number', 'like', '%' . $search . '%')
                    ->orWhere('make', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhereHas('category', fn ($c) => $c->where('name', 'like', '%' . $search . '%'))
                    ->orWhereHas('assignedEmployee', fn ($c) => $c->where('name', 'like', '%' . $search . '%'));
            });
        }
        if ($roomId !== '') {
            $query->where('room_id', $roomId);
        }
        if ($status !== '') {
            $query->where('status', $status);
        }

        $assets = $query->get();
        $rooms = Room::orderBy('name')->get()->keyBy('id');
        $roomSections = [];

        if ($roomId !== '') {
            $room = $rooms->get((int) $roomId);
            if ($room) {
                $roomAssets = $assets->where('room_id', (int) $roomId);
                $roomSections[] = $this->buildRoomSection($room, $roomAssets);
            }
        } else {
            foreach ($rooms as $room) {
                $roomAssets = $assets->where('room_id', $room->id);
                if ($roomAssets->isEmpty()) {
                    continue;
                }
                $roomSections[] = $this->buildRoomSection($room, $roomAssets);
            }
            $noRoomAssets = $assets->whereNull('room_id');
            if ($noRoomAssets->isNotEmpty()) {
                $roomSections[] = $this->buildRoomSection(null, $noRoomAssets);
            }
        }

        return view('find-assets.index', [
            'roomSections' => $roomSections,
            'rooms' => $rooms->values(),
            'filters' => ['search' => $search, 'room_id' => $roomId, 'status' => $status],
        ]);
    }

    private function buildRoomSection(?Room $room, Collection $assets): object
    {
        $byEmployee = $assets->groupBy('assigned_employee_id');
        $desks = [];
        $employeeIds = $byEmployee->keys()->filter(fn ($k) => $k !== null && $k !== '');
        $employees = \App\Models\Employee::whereIn('id', $employeeIds)->orderBy('name')->get()->keyBy('id');
        foreach ($employees as $emp) {
            $desks[] = (object) ['employee' => $emp, 'assets' => $byEmployee->get($emp->id, collect())];
        }
        $unassigned = $byEmployee->get(null, collect());
        if ($unassigned->isNotEmpty()) {
            $desks[] = (object) ['employee' => null, 'assets' => $unassigned];
        }
        if (empty($desks) && $assets->isNotEmpty()) {
            $desks[] = (object) ['employee' => null, 'assets' => $assets];
        }
        return (object) [
            'room' => $room,
            'desks' => $desks,
            'total_assets' => $assets->count(),
        ];
    }

    public static function iconForCategory(?string $slug): string
    {
        return self::CATEGORY_ICONS[$slug ?? ''] ?? 'bi-box-seam';
    }
}
