
@php
    $from = $from ?? 1;
    $to = $to ?? 6;
    $total = $total ?? 72;
    $currentPage = $currentPage ?? 1;
    $lastPage = $lastPage ?? 8;
@endphp

<div class="bg-white rounded-2xl border border-slate-200 px-5 py-4 flex flex-wrap items-center justify-between gap-3">

    <p class="text-sm text-slate-500">
        Showing <span class="font-semibold text-slate-700">{{ $from }} to {{ $to }}</span> of {{ $total }} transactions
    </p>

    <div class="flex items-center gap-2">
        <button type="button" class="px-4 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
                @if($currentPage <= 1) disabled @endif>
            Previous
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

        <button type="button" class="px-4 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
                @if($currentPage >= $lastPage) disabled @endif>
            Next
        </button>
    </div>

</div>