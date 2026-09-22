<div class="flex items-center gap-3">
    <div class="relative flex-1">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"><img src="{{ asset('icons/search.png') }}" class="w-5 h-5 object-contain"></span>
        <input
            type="text"
            id="fruit-search"
            placeholder="{{ __('Search fruit by name or code ...') }}"
            class="w-full pl-11 pr-10 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500"
        >
        <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
            <span aria-hidden="true">✕</span>
        </button>
    </div>

    <div class="flex bg-slate-100 rounded-xl p-1 text-sm font-medium">
        <button type="button" class="px-4 py-1.5 rounded-lg bg-white shadow-sm text-slate-700">{{ __('Show All') }}</button>
        <button type="button" class="px-4 py-1.5 rounded-lg text-slate-500">{{ __('In Stock Only') }}</button>
    </div>
</div>
