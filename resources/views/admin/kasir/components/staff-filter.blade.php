@php
    // Ganti dengan angka asli dari controller
    $tabs = $tabs ?? [
        ['label' => 'All Cashiers', 'count' => 8, 'active' => true],
        ['label' => 'Currently On Shift', 'count' => 3],
        ['label' => 'Off Duty', 'count' => 4],
        ['label' => 'Inactive', 'count' => 1],
    ];
@endphp

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">

    <div class="relative w-full lg:max-w-xs">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 leading-none">🔍</span>
        <input
            type="text"
            id="staff-search"
            placeholder="{{ __('Search staff name, ID or email...') }}"
            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
        >
    </div>

    <div class="flex flex-wrap items-center gap-1 bg-slate-50 rounded-xl p-1">
        @foreach ($tabs as $tab)
            <button
                type="button"
                class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ ($tab['active'] ?? false) ? 'bg-white shadow-sm text-slate-800' : 'text-slate-500 hover:text-slate-700' }}"
            >
                {{ $tab['label'] }}
                <span class="{{ ($tab['active'] ?? false) ? 'text-slate-400' : 'text-slate-400' }}">({{ $tab['count'] }})</span>
            </button>
        @endforeach
    </div>

</div>
