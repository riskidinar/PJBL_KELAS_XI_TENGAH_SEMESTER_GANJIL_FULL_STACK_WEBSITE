@php
    // Ganti dengan data dari controller
    $statuses = $statuses ?? ['All Statuses (142)'];
    $units = $units ?? ['All Units'];
    $sorts = $sorts ?? ['Name (A - Z)'];

    $categories = $categories ?? [
        ['label' => 'All Categories', 'count' => 142, 'active' => true],
        ['label' => 'Bananas & Tropical', 'count' => 34],
        ['label' => 'Citrus & Oranges', 'count' => 28],
        ['label' => 'Apples & Pears', 'count' => 22],
        ['label' => 'Berries & Melons', 'count' => 38],
    ];
@endphp

<div class="space-y-4">

    {{-- Baris 1: search + dropdown + tombol filter --}}
    <div class="flex flex-col lg:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">🔍</span>
            <input
                type="text"
                id="fruit-search"
                placeholder="{{ __('Search by fruit name or code fruit') }}"
                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
            >
        </div>

        <label class="flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
            <span class="text-slate-400 font-medium">{{ __('Status') }}:</span>
            <select class="font-medium text-slate-700 bg-transparent focus:outline-none">
                @foreach ($statuses as $opt) <option>{{ $opt }}</option> @endforeach
            </select>
        </label>

        <label class="flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
            <span class="text-slate-400 font-medium">{{ __('Unit') }}:</span>
            <select class="font-medium text-slate-700 bg-transparent focus:outline-none">
                @foreach ($units as $opt) <option>{{ $opt }}</option> @endforeach
            </select>
        </label>

        <label class="flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm">
            <span class="text-slate-400 font-medium">{{ __('Sort') }}:</span>
            <select class="font-medium text-slate-700 bg-transparent focus:outline-none">
                @foreach ($sorts as $opt) <option>{{ $opt }}</option> @endforeach
            </select>
        </label>

        <button type="button" class="w-11 h-11 shrink-0 flex items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:bg-slate-50" title="Filter lanjutan">
            🎛️
        </button>
    </div>

    {{-- Baris 2: tab kategori --}}
    <div class="flex flex-wrap gap-2">
        @foreach ($categories as $cat)
            <button
                type="button"
                class="px-4 py-2 rounded-full text-sm font-medium transition
                       {{ ($cat['active'] ?? false)
                            ? 'bg-emerald-600 text-white'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
            >
                {{ $cat['label'] }} ({{ $cat['count'] }})
            </button>
        @endforeach
    </div>

</div>
