<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="color-scheme: light;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Source Serif 4', Georgia, 'Times New Roman', serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #1a1a1a;
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
        }
        .no-print { margin-bottom: 1.5rem; }
        @media print {
            body { padding: 0; max-width: none; }
            .no-print { display: none !important; }
            a { color: #1a1a1a; text-decoration: none; }
            thead { display: table-header-group; }
            tr { page-break-inside: avoid; }
        }
        .report-header {
            border-bottom: 2px solid #1a1a1a;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .report-title { font-size: 18pt; font-weight: 700; margin: 0 0 4px 0; color: #1a1a1a; }
        .report-title-icon { display: inline-block; width: 1em; height: 1em; margin-right: 6px; vertical-align: -0.2em; opacity: 0.9; }
        .report-meta { font-size: 10pt; color: #555; margin: 0; }
        .report-section { margin-bottom: 24px; }
        .report-section h2 {
            font-size: 12pt;
            font-weight: 700;
            margin: 0 0 10px 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #ccc;
        }
        table.report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }
        table.report-table th,
        table.report-table td {
            border: 1px solid #ddd;
            padding: 6px 10px;
            text-align: left;
        }
        table.report-table th {
            background: #f5f5f5;
            font-weight: 600;
        }
        table.report-table tbody tr:nth-child(even) { background: #fafafa; }
        @media print {
            table.report-table tbody tr:nth-child(even) { background: #f9f9f9; }
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }
        .summary-box {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        .summary-box .num { font-size: 20pt; font-weight: 700; }
        .summary-box .label { font-size: 9pt; color: #555; margin-top: 4px; }
        .category-block { margin-bottom: 20px; page-break-inside: avoid; }
        .category-block h3 { font-size: 11pt; margin: 0 0 8px 0; color: #333; }
        .status-block { margin-bottom: 20px; page-break-inside: avoid; }
        .status-block h3 { font-size: 11pt; margin: 0 0 8px 0; color: #333; }
        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            font-size: 12pt;
            font-family: inherit;
            font-weight: 600;
            color: #fff;
            background: #0078d4;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-print:hover { background: #106ebe; }
    </style>
</head>
<body>
    <div class="no-print">
        <button type="button" class="btn-print" onclick="window.print();">Print report</button>
    </div>
    <header class="report-header">
        <h1 class="report-title">@if($type === 'warranty')<span class="report-title-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/></svg></span>@endif{{ $title }}</h1>
        <p class="report-meta">{{ config('app.name') }} · Generated {{ $generatedAt }}</p>
    </header>

    @if($type === 'summary')
        <div class="report-section">
            <div class="summary-grid">
                <div class="summary-box">
                    <div class="num">{{ $data['total'] }}</div>
                    <div class="label">Total assets</div>
                </div>
                <div class="summary-box">
                    <div class="num">{{ $data['assignedCount'] }}</div>
                    <div class="label">Assigned</div>
                </div>
                @foreach($data['byStatus'] as $status => $count)
                    <div class="summary-box">
                        <div class="num">{{ $count }}</div>
                        <div class="label">{{ ucfirst(str_replace('_', ' ', $status)) }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="report-section">
            <h2>By category</h2>
            <table class="report-table">
                <thead><tr><th>Category</th><th>Count</th></tr></thead>
                <tbody>
                    @foreach($data['byCategory'] as $cat)
                        <tr><td>{{ $cat->name }}</td><td>{{ $cat->assets_count }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($type === 'by-category')
        @foreach($data['categories'] as $cat)
            @php $items = $data['items'][$cat->id] ?? collect(); @endphp
            <div class="report-section category-block">
                <h2>{{ $cat->name }} ({{ $items->count() }})</h2>
                @if($items->isNotEmpty())
                    <table class="report-table">
                        <thead><tr><th>Tag</th><th>Serial</th><th>Make / Model</th><th>Status</th><th>Room</th><th>Assigned to</th></tr></thead>
                        <tbody>
                            @foreach($items as $a)
                                <tr>
                                    <td>{{ $a->asset_tag }}</td>
                                    <td>{{ $a->serial_number ?? '—' }}</td>
                                    <td>{{ $a->make }} {{ $a->model }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $a->status)) }}</td>
                                    <td>{{ $a->room?->name ?? '—' }}</td>
                                    <td>{{ $a->assignedEmployee?->name ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No assets in this category.</p>
                @endif
            </div>
        @endforeach
    @elseif($type === 'by-status')
        @foreach($data['statuses'] as $status)
            @php $items = $data['items'][$status] ?? collect(); @endphp
            <div class="report-section status-block">
                <h2>{{ ucfirst(str_replace('_', ' ', $status)) }} ({{ $items->count() }})</h2>
                @if($items->isNotEmpty())
                    <table class="report-table">
                        <thead><tr><th>Tag</th><th>Category</th><th>Serial</th><th>Make / Model</th><th>Room</th><th>Assigned to</th></tr></thead>
                        <tbody>
                            @foreach($items as $a)
                                <tr>
                                    <td>{{ $a->asset_tag }}</td>
                                    <td>{{ $a->category?->name ?? '—' }}</td>
                                    <td>{{ $a->serial_number ?? '—' }}</td>
                                    <td>{{ $a->make }} {{ $a->model }}</td>
                                    <td>{{ $a->room?->name ?? '—' }}</td>
                                    <td>{{ $a->assignedEmployee?->name ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach
    @elseif($type === 'assigned')
        <div class="report-section">
            <table class="report-table">
                <thead><tr><th>Asset tag</th><th>Category</th><th>Serial</th><th>Assigned to</th></tr></thead>
                <tbody>
                    @foreach($data['assets'] as $a)
                        <tr>
                            <td>{{ $a->asset_tag }}</td>
                            <td>{{ $a->category?->name ?? '—' }}</td>
                            <td>{{ $a->serial_number ?? '—' }}</td>
                            <td>{{ $a->assignedEmployee?->name ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($data['assets']->isEmpty())
                <p>No assets currently assigned.</p>
            @endif
        </div>
    @elseif($type === 'warranty')
        <div class="report-section">
            <table class="report-table">
                <thead><tr><th>Asset tag</th><th>Category</th><th>Warranty expiry</th><th>Assigned to</th></tr></thead>
                <tbody>
                    @foreach($data['assets'] as $a)
                        <tr>
                            <td>{{ $a->asset_tag }}</td>
                            <td>{{ $a->category?->name ?? '—' }}</td>
                            <td>{{ $a->warranty_expiry?->format('M j, Y') ?? '—' }}</td>
                            <td>{{ $a->assignedEmployee?->name ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($data['assets']->isEmpty())
                <p>No assets with warranty expiring in the next 90 days.</p>
            @endif
        </div>
    @elseif($type === 'maintenance')
        <div class="report-section">
            <table class="report-table">
                <thead><tr><th>Date</th><th>Asset</th><th>Type</th><th>Notes</th><th>Performed by</th></tr></thead>
                <tbody>
                    @foreach($data['logs'] as $log)
                        <tr>
                            <td>{{ $log->date->format('M j, Y') }}</td>
                            <td>{{ $log->asset?->asset_tag ?? '—' }}</td>
                            <td>{{ ucfirst($log->type) }}</td>
                            <td>{{ $log->notes ? \Illuminate\Support\Str::limit($log->notes, 60) : '—' }}</td>
                            <td>{{ $log->performedBy?->name ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($data['logs']->isEmpty())
                <p>No maintenance logs.</p>
            @endif
        </div>
    @elseif($type === 'employees-with-assets')
        @foreach($data['details'] as $item)
            <div class="report-section category-block">
                <h2>{{ $item['employee']->name }} ({{ $item['assets']->count() }} asset(s))</h2>
                <table class="report-table">
                    <thead><tr><th>Asset tag</th><th>Category</th><th>Serial</th></tr></thead>
                    <tbody>
                        @foreach($item['assets'] as $a)
                            <tr><td>{{ $a->asset_tag }}</td><td>{{ $a->category?->name ?? '—' }}</td><td>{{ $a->serial_number ?? '—' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
        @if(empty($data['details']))
            <p>No employees with assigned assets.</p>
        @endif
    @endif

</body>
</html>
