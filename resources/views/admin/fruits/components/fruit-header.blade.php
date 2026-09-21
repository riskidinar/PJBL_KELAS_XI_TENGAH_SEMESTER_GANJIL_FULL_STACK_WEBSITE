<div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">

    <div>
        <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-bold tracking-wide bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md">
                {{ __('INVENTORY MASTER') }}
            </span>
            <span class="text-xs text-slate-400 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                {{ __('Terminal') }} {{ $terminal ?? '01' }} {{ __('Registered Catalog') }}
            </span>
        </div>

        <h1 class="text-3xl font-bold text-slate-800">{{ __('Fruit Inventory & Stock Management') }}</h1>
        <p class="text-slate-400 mt-1 max-w-lg">
            {{ __('Manage fruit catalog, unit pricing, minimum stock thresholds, and live inventory status.') }}
        </p>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <button type="button" class="flex items-center gap-2 text-sm font-medium border border-slate-200 px-4 py-2.5 rounded-xl hover:bg-slate-50">
            <span class="leading-none">⬆️</span> {{ __('Import CSV') }}
        </button>
        <a href="{{ route('admin.fruits.create') }}"
           class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition whitespace-nowrap">
            <span class="leading-none">⊕</span> {{ __('Add New Fruit') }}
        </a>
    </div>

</div>
