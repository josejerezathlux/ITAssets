@extends('layouts.app')

@section('title', 'Rooms')

@section('content')
<div class="corp-page-header">
    <div>
        <h2 class="corp-page-title mb-1"><i class="bi bi-building me-2"></i>Rooms</h2>
        <p class="text-muted small mb-0">Physical locations where assets can be stored or used.</p>
    </div>
    @can('create', App\Models\Room::class)
        <a href="{{ route('rooms.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New Room</a>
    @endcan
</div>

<div class="fluent-tip-card fluent-dismissible mb-4" data-dismiss-key="rooms-tip">
    <i class="bi bi-lightbulb fluent-tip-icon"></i>
    <div class="fluent-tip-body">
        <div class="fluent-tip-title">Rooms and assets</div>
        <p class="mb-0 small">Assign a room to an asset to track where it is located. You can filter assets by room on the Assets page and use bulk actions to move multiple assets at once.</p>
    </div>
    <button type="button" class="fluent-card-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
</div>

<div class="corp-card">
    <div class="table-responsive">
    <table class="table corp-table align-middle mb-0">
        <thead>
            <tr>
                <th><i class="bi bi-building me-1"></i>Name</th>
                <th><i class="bi bi-geo-alt me-1"></i>Location</th>
                <th><i class="bi bi-upc me-1"></i>Code</th>
                <th><i class="bi bi-laptop me-1"></i>Assets</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
                <tr>
                    <td><a href="{{ route('rooms.show', $room) }}" class="corp-link">{{ $room->name }}</a></td>
                    <td>@if($room->location)<span class="badge fluent-badge-neutral">{{ $room->location }}</span>@else<span class="text-muted">—</span>@endif</td>
                    <td>@if($room->code)<span class="badge fluent-badge-info">{{ $room->code }}</span>@else<span class="text-muted">—</span>@endif</td>
                    <td><span class="badge fluent-badge-primary">{{ $room->assets_count }}</span></td>
                    <td>
                        @can('update', $room)
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete', $room)
                            <form method="POST" action="{{ route('rooms.destroy', $room) }}" class="d-inline" onsubmit="return confirm('Delete this room?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No rooms.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div class="fluent-pagination-wrap">{{ $rooms->links() }}</div>
@endsection
