@extends('layouts.app')

@section('title', $room->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">{{ $room->name }}</h1>
    <div class="d-flex gap-2">
        @can('update', $room)
            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete', $room)
            <form method="POST" action="{{ route('rooms.destroy', $room) }}" class="d-inline" onsubmit="return confirm('Delete this room?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        @endcan
        <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr><th width="120">Location</th><td>{{ $room->location ?? '—' }}</td></tr>
            <tr><th>Code</th><td>{{ $room->code ?? '—' }}</td></tr>
            <tr><th>Assets in room</th><td>{{ $room->assets_count }}</td></tr>
        </table>
    </div>
</div>

@if($room->assets_count > 0)
    <div class="card">
        <div class="card-header">Assets in this room</div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach($room->assets as $asset)
                    <li class="list-group-item">
                        <a href="{{ route('assets.show', $asset) }}" class="corp-link">{{ $asset->asset_tag }}</a>
                        <span class="text-muted"> — {{ $asset->category?->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endsection
