@php
    $from = $from ?? 1;
    $to = $to ?? 6;
    $total = $total ?? 8;
    $currentPage = $currentPage ?? 1;
    $lastPage = $lastPage ?? 2;
@endphp

<div class="flex items-center justify-between px-5 py-4 border-t border-slate-100">

    <p class="text-sm text-slate-500">
        Showing {{ $from }} to {{ $to }} of {{ $total }} registered cashiers
    </p>

    <div class="flex items-center gap-2">
        <button type="button" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
                @if($currentPage <= 1) disabled @endif>
            ‹
        </button>

        @for ($page = 1; $page <= $lastPage; $page++)
            <button
                type="button"
                class="w-8 h-8 rounded-full text-sm font-medium transition
                       {{ $page === $currentPage ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}"
            >
                {{ $page }}
            </button>
        @endfor

        <button type="button" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
                @if($currentPage >= $lastPage) disabled @endif>
            ›
        </button>
    </div>

</div>