@php
    // Ganti dengan $stats dari controller
    $stats = $stats ?? [
        'total_varieties' => 142,
        'in_stock' => 134,
        'in_stock_percent' => 94.3,
        'low_stock' => 5,
        'out_of_stock' => 3,
        'valuation' => 42_850_000,
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-slate-400 leading-tight">{{ __('TOTAL FRUIT') }}<br>{{ __('VARIETIES') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-slate-100 rounded-lg">🗂️</span>
        </div>
        <p class="text-2xl font-bold text-slate-800">{{ $stats['total_varieties'] }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-slate-400 leading-tight">{{ __('IN STOCK (SAFE)') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-emerald-100 rounded-lg">✅</span>
        </div>
        <p class="text-2xl font-bold text-emerald-600">{{ $stats['in_stock'] }}</p>
        <div class="flex items-center gap-2 mt-1">
            <span class="text-xs font-semibold bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md">{{ $stats['in_stock_percent'] }}% Ready Stock</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-slate-400 leading-tight">{{ __('LOW STOCK ALERT') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-orange-100 rounded-lg">⚠️</span>
        </div>
        <p class="text-2xl font-bold text-orange-500">{{ $stats['low_stock'] }}</p>
        <div class="flex items-center gap-2 mt-1">
            <span class="text-xs font-semibold bg-orange-50 text-orange-600 px-2 py-0.5 rounded-md">{{ __('Needs Reorder') }}</span>
        </div>
        <p class="text-xs text-slate-400 mt-1">{{ __('Fruits') }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-slate-400 leading-tight">{{ __('OUT OF STOCK') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-red-100 rounded-lg">🚫</span>
        </div>
        <p class="text-2xl font-bold text-red-600">{{ $stats['out_of_stock'] }} <span class="text-sm font-medium text-slate-400">{{ __('Fruits') }}</span></p>
        <span class="inline-block text-xs font-semibold bg-red-500 text-white px-2 py-0.5 rounded-md mt-1">{{ __('Unavailable') }}</span>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-slate-400 leading-tight">{{ __('INVENTORY') }}<br>{{ __('VALUATION') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-sky-100 rounded-lg">📗</span>
        </div>
        <p class="text-xl font-bold text-slate-800">Rp {{ number_format($stats['valuation'] / 1_000_000, 2) }}M</p>
    </div>

</div>
