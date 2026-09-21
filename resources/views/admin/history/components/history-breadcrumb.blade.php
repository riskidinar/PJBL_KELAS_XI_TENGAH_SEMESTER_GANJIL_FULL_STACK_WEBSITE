@php
    // Ganti dengan array breadcrumb dari controller kalau perlu dinamis
    $breadcrumbs = $breadcrumbs ?? [
        ['label' => 'Admin Portal', 'route' => 'admin.dashboard.index'],
        ['label' => 'Audit & Transactions', 'route' => null],
        ['label' => 'Transaction History & Audit Log', 'route' => null],
    ];

    $registerStatus = $registerStatus ?? [
        'total' => 3, 'online' => 3, 'sync' => 'Real-time', 'latency' => '14ms',
    ];
@endphp

<div class="mb-4">
    <nav class="text-sm text-slate-400 flex items-center gap-2 mb-3">
        @foreach ($breadcrumbs as $i => $crumb)
            @if ($i > 0)
                <span>›</span>
            @endif
            @if ($crumb['route'])
                <a href="{{ route($crumb['route']) }}" class="hover:text-slate-600">{{ $crumb['label'] }}</a>
            @else
                <span class="{{ $i === count($breadcrumbs) - 1 ? 'text-slate-500 font-medium' : '' }}">{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </nav>

    <div class="inline-flex items-center gap-2 text-xs font-medium text-slate-500 bg-slate-50 border border-slate-100 rounded-full px-3 py-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
        All {{ $registerStatus['total'] }} Registers Online (Sync: {{ $registerStatus['sync'] }} • Latency {{ $registerStatus['latency'] }})
    </div>
</div>