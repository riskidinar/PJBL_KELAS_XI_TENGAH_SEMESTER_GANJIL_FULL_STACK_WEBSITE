@php
    // Ganti dengan data dari controller
    $registers = $registers ?? ['All Registers (3 Active)'];
    $cashiers = $cashiers ?? ['All Cashiers'];
    $paymentMethods = $paymentMethods ?? ['All Payment Methods'];
    $statuses = $statuses ?? ['All Statuses (72)'];

    $timeWindow = $timeWindow ?? 'today';
    $todayLabel = $todayLabel ?? 'Today (' . now()->format('d M Y') . ')';
    $weekLabel = $weekLabel ?? 'This Week (W37)';
    $totalMatches = $totalMatches ?? 72;
@endphp

<div class="space-y-4">

    {{-- Baris 1: search + 4 dropdown --}}
    <div class="flex flex-col lg:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">  <img src="{{ asset('icons/search.png') }}" class="w-5 h-5 object-contain"></span>
            <input
                type="text"
                id="admin-history-search"
                placeholder="{{ __('Filter by TRX ID, Cashier, Fruit SKU') }}"
                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
            >
        </div>

        <select class="rounded-xl border border-slate-200 text-sm font-medium text-slate-600 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">
            @foreach ($registers as $opt) <option>{{ $opt }}</option> @endforeach
        </select>

        <select class="rounded-xl border border-slate-200 text-sm font-medium text-slate-600 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">
            @foreach ($cashiers as $opt) <option>{{ $opt }}</option> @endforeach
        </select>

        <select class="rounded-xl border border-slate-200 text-sm font-medium text-slate-600 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">
            @foreach ($paymentMethods as $opt) <option>{{ $opt }}</option> @endforeach
        </select>

        <select class="rounded-xl border border-slate-200 text-sm font-medium text-slate-600 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">
            @foreach ($statuses as $opt) <option>{{ $opt }}</option> @endforeach
        </select>
    </div>

    {{-- Baris 2: Time window + aksi --}}
    <div class="flex flex-wrap items-center gap-3">

        <span class="text-sm font-medium text-slate-500">{{ __('Time Window') }}:</span>

        <button type="button" class="px-4 py-2 rounded-full text-sm font-semibold {{ $timeWindow === 'today' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ $todayLabel }}
        </button>
        <button type="button" class="px-4 py-2 rounded-full text-sm font-medium {{ $timeWindow === 'yesterday' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Yesterday
        </button>
        <button type="button" class="px-4 py-2 rounded-full text-sm font-medium {{ $timeWindow === 'week' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            {{ $weekLabel }}
        </button>
        <button type="button" class="px-4 py-2 rounded-full text-sm font-medium flex items-center gap-1.5 {{ $timeWindow === 'custom' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            <span class="leading-none">  <img src="{{ asset('icons/calender_topbar_kasir.png') }}" class="w-4 h-4 object-contain"></span> Custom Date
        </button>

        <span class="text-slate-200">|</span>

        <button type="button" class="flex items-center gap-1.5 text-sm font-medium text-emerald-700 hover:text-emerald-800">
            <span class="leading-none"><img src="{{ asset('icons/refresh.png') }}"  class="w-4 h-4 object-contain"></span> Refresh Log
        </button>

        <span class="text-slate-200">|</span>

        <button type="button" class="text-sm font-medium text-slate-500 hover:text-slate-700">
            Reset All Filters
        </button>

        <span class="text-slate-200">|</span>

        <span class="text-sm text-slate-400">
            Found {{ $totalMatches }} total matches
        </span>
    </div>

</div>
