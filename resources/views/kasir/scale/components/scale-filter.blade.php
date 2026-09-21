@php
    // Ganti dengan $categories dari controller
    $categories = $categories ?? [
        ['label' => 'All Fruits', 'count' => 18, 'active' => true],
        ['label' => 'Bananas & Tropical'],
        ['label' => 'Citrus & Oranges'],
        ['label' => 'Apples & Pears'],
    ];

    $totalMatches = $totalMatches ?? 72;
@endphp

<div class="space-y-4">

    {{-- Kotak pencarian --}}
    <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">🔍</span>
        <input
            type="text"
            id="scale-search"
            placeholder="{{ __('Filter by TRX ID or Name Fruit') }}"
            class="w-full max-w-xl pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
        >
    </div>

    {{-- Filter kategori + aksi --}}
    <div class="flex flex-wrap items-center gap-3">

        @foreach ($categories as $cat)
            <button
                type="button"
                class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ ($cat['active'] ?? false)
                            ? 'bg-emerald-600 text-white'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
            >
                {{ $cat['label'] }}@if(isset($cat['count'])) {{ $cat['count'] }}@endif
            </button>
        @endforeach

        <span class="text-slate-200">|</span>

        <button type="button" class="flex items-center gap-1.5 text-sm font-medium text-emerald-700 hover:text-emerald-800">
            <span class="leading-none">🔄</span> Refresh Log
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
