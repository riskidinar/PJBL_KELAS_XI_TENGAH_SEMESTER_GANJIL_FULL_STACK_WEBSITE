<div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">

    <div>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-800">{{ __('Transaction History & Audit Logs') }}</h1>
            <span class="text-xs font-semibold bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live Feed
            </span>
        </div>
        <p class="text-slate-400 mt-2 max-w-2xl">
           {{ __('Complete immutable record of all processed cashier sales, tare measurements, stock decrements, cash drawer kicks, and thermal receipt reprints.') }}
        </p>
    </div>

    <button type="button" class="shrink-0 flex items-center gap-2 text-sm font-medium border border-slate-200 px-4 py-2.5 rounded-xl hover:bg-slate-50">
        <span class="leading-none">⬆️</span> Import CSV
    </button>

</div>
