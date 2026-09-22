@php
    // Ganti dengan data dari controller: $stats
    $stats = $stats ?? [
        'revenue_today'   => 4_850_000,
        'transactions'    => 64,
        'weight_sold'     => 186.5,
        'fresh_categories'=> 8,
        'fruit_types'     => 24,
        'stock_plentiful' => 18,
        'staff_on_duty'   => 3,
        'staff_names'     => 'Rizki, Siti, Dian',
        'low_stock'       => 3,
        'out_of_stock'    => 1,
        'out_of_stock_item' => 'Alphonso Mango (0 kg)',
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-7 gap-4 mb-6">

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-slate-400 leading-tight">{{ __('REVENUE') }}<br>{{ __('TODAY') }}</p>
        </div>
        <p class="text-xl font-bold text-slate-800">Rp {{ number_format($stats['revenue_today'] / 1_000_000, 2) }}M</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
            <p class="text-xs font-semibold text-slate-400 mb-3">{{ __('TRANSACTIONS') }}</p>
            <p class="text-xl font-bold text-slate-800">{{ $stats['transactions'] }} <span class="text-sm font-medium text-slate-400">{{ __('Orders') }}</span></p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
            <p class="text-xs font-semibold text-slate-400 mb-3">{{ __('WEIGHT SOLD') }}</p>
        <p class="text-xl font-bold text-slate-800">{{ $stats['weight_sold'] }} kg</p>
        <p class="text-xs text-emerald-600 mt-1">{{ $stats['fresh_categories'] }} {{ __('fresh categories') }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
            <p class="text-xs font-semibold text-slate-400 mb-3">{{ __('FRUITS CATEGORIES') }}</p>
        <p class="text-xl font-bold text-slate-800">{{ $stats['fruit_types'] }} Types</p>
        <p class="text-xs text-slate-400 mt-1">{{ $stats['stock_plentiful'] }} {{ __('plentiful in stock') }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-4">
            <p class="text-xs font-semibold text-slate-400 mb-3">{{ __('STAFF ON DUTY') }}</p>
        <p class="text-xl font-bold text-slate-800">{{ $stats['staff_on_duty'] }} Cashiers</p>
        <p class="text-xs text-slate-400 mt-1 truncate">{{ $stats['staff_names'] }}</p>
    </div>

    <div class="bg-orange-50 rounded-2xl border border-orange-100 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-orange-500 leading-tight">{{ __('LOW') }}<br>{{ __('STOCK') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-orange-500 text-white rounded-lg"><img src="{{ asset('icons/low_admin.png') }}" class="w-4 h-4 object-contain"></span>
        </div>
        <p class="text-xl font-bold text-orange-700">{{ $stats['low_stock'] }} Fruits</p>
            <p class="text-xs text-orange-500 mt-1">{{ __('Reorder required') }}</p>
    </div>

    <div class="bg-red-50 rounded-2xl border border-red-100 p-4">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-semibold text-red-500 leading-tight">{{ __('OUT OF') }}<br>{{ __('STOCK') }}</p>
            <span class="w-7 h-7 flex items-center justify-center bg-red-500 text-white rounded-lg"><img src="{{ asset('icons/solt_admin.png') }}" class="w-4 h-4 object-contain"></span>
        </div>
        <p class="text-xl font-bold text-red-700">{{ $stats['out_of_stock'] }} Fruit</p>
        <p class="text-xs text-red-500 mt-1">{{ $stats['out_of_stock_item'] }}</p>
    </div>

</div>
