@php
    $from = $from ?? 1;
    $to = $to ?? 8;
    $total = $total ?? 142;
    $perPage = $perPage ?? 10;
    $currentPage = $currentPage ?? 1;
    $lastPage = $lastPage ?? 18;
@endphp

<div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-t border-slate-100">

    <div class="flex items-center gap-3 text-sm text-slate-500">
        <span>{{ __('Showing :from to :to of :total fruits', ['from' => $from, 'to' => $to, 'total' => $total]) }}</span>
        <span class="text-slate-300">|</span>
        <label class="flex items-center gap-2">
            Items per page:
            <select class="border border-slate-200 rounded-lg px-2 py-1 text-sm font-medium text-slate-700 focus:outline-none">
                <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            </select>
        </label>
    </div>

    <div class="flex items-center gap-2">
        <button type="button" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
                @if($currentPage <= 1) disabled @endif>
            ‹
        </button>

        @for ($page = 1; $page <= min(3, $lastPage); $page++)
            <button
                type="button"
                class="w-8 h-8 rounded-full text-sm font-medium transition
                       {{ $page === $currentPage ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}"
            >
                {{ $page }}
            </button>
        @endfor

        @if ($lastPage > 4)
            <span class="text-slate-400 px-1">...</span>
        @endif

        @if ($lastPage > 3)
            <button
                type="button"
                class="w-8 h-8 rounded-full text-sm font-medium {{ $lastPage === $currentPage ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}"
            >
                {{ $lastPage }}
            </button>
        @endif

        <button type="button" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
                @if($currentPage >= $lastPage) disabled @endif>
            ›
        </button>
    </div>

</div>
