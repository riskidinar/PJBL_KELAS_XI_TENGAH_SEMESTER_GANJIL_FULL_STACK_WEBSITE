@php
    // Ganti dengan $stats dari controller
    $stats = $stats ?? [
        'total_cashiers' => 8,
        'active_today' => 3,
        'shift_sales_today' => 4850000,
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-400 mb-2">{{ __('Total Cashiers') }}</p>
            <p class="text-3xl font-bold text-slate-800">{{ $stats['total_cashiers'] }}</p>
            <p class="text-sm text-slate-400 mt-1">{{ __('Registered') }}</p>
        </div>
        <span class="w-10 h-10 flex items-center justify-center bg-emerald-50 rounded-xl text-lg"><img src="{{ asset('icons/i1_kasir.png') }}" class="w-5 h-5 object-contain"></span>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-400 mb-2">{{ __('Active On Shift Today') }}</p>
            <p class="text-3xl font-bold text-emerald-600">{{ $stats['active_today'] }}</p>
            <p class="text-sm text-slate-400 mt-1">{{ __('Cashiers Online') }}</p>
        </div>
        <span class="w-10 h-10 flex items-center justify-center bg-emerald-50 rounded-xl text-lg"><img src="{{ asset('icons/i2_kasir.png') }}" class="w-5 h-5 object-contain"></span>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-400 mb-2">{{ __('Today\'s Shift Sales') }}</p>
            <p class="text-3xl font-bold text-slate-800">Rp {{ number_format($stats['shift_sales_today'], 0, ',', '.') }}</p>
        </div>
        <span class="w-10 h-10 flex items-center justify-center bg-orange-50 rounded-xl text-lg"><img src="{{ asset('icons/i3_kasir.png') }}" class="w-5 h-5 object-contain"></span>
    </div>

</div>
