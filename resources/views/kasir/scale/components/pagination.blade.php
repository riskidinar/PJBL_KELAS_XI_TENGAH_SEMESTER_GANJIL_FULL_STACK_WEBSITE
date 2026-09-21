{{--
    Dipanggil dua kali kalau perlu (atas & bawah tabel):
    @include('kasir.scale.components.pagination', ['position' => 'top'])
    Ganti $currentPage/$lastPage dari paginator Laravel asli ($items->currentPage(), dst)
    kalau kamu pakai ->paginate() di controller.
--}}
@php
    $currentPage = $currentPage ?? 1;
    $lastPage = $lastPage ?? 3;
    $perPage = $perPage ?? 20;
@endphp

<div class="flex items-center gap-2 flex-wrap">
    <button type="button" class="px-4 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
            @if($currentPage <= 1) disabled @endif>
        Previous {{ $perPage }}
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

    <button type="button" class="px-4 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-500 hover:bg-slate-200 disabled:opacity-50"
            @if($currentPage >= $lastPage) disabled @endif>
        Next {{ $perPage }}
    </button>
</div>