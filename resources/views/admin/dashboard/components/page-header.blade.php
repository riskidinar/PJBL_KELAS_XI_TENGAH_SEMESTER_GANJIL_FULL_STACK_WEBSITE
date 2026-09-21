@php
    $range = $range ?? 'today'; // today | week | month | custom
@endphp

<div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">

    <div>
        <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-bold tracking-wide bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md">
                STORE TERMINAL {{ $terminal ?? '01' }}
            </span>
            <span class="text-xs text-slate-400 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Shift {{ $shift ?? '01' }} Active
            </span>
        </div>

        <h1 class="text-3xl font-bold text-slate-800">{{ __('Product Overview & Analytics') }}</h1>
        <p class="text-slate-400 mt-1 max-w-md">
            {{ __('Real-time sales performance, inventory alerts, and cashier tracking') }}
        </p>
    </div>

</div>
