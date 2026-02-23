<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Room::class);
        $rooms = Room::withCount('assets')->orderBy('name')->paginate(20);
        return view('rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        $this->authorize('create', Room::class);
        return view('rooms.create');
    }

    public function store(StoreRoomRequest $request): RedirectResponse
    {
        Room::create($request->validated());
        return redirect()->route('rooms.index')->with('success', 'Room added.');
    }

    public function show(Room $room): View
    {
        $this->authorize('view', $room);
        $room->loadCount('assets');
        $room->load('assets.category');
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room): View
    {
        $this->authorize('update', $room);
        return view('rooms.edit', compact('room'));
    }

    public function update(UpdateRoomRequest $request, Room $room): RedirectResponse
    {
        $room->update($request->validated());
        return redirect()->route('rooms.index')->with('success', 'Room updated.');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $this->authorize('delete', $room);
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room removed.');
    }
}
