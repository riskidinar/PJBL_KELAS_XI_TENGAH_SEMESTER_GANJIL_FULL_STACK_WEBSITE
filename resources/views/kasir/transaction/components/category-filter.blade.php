@php
    // Sementara pakai data dummy, nanti ganti dengan $categories dari controller
    $categories = $categories ?? [
        ['label' => 'All Fruits', 'count' => 18, 'active' => true],
        ['label' => 'Bananas & Tropical'],
        ['label' => 'Citrus & Oranges'],
        ['label' => 'Apples & Pears'],
    ];
@endphp

<div class="flex flex-wrap gap-2">
    @foreach ($categories as $cat)
        <button
            type="button"
            class="px-4 py-2 rounded-full text-sm font-medium transition
                   {{ ($cat['active'] ?? false)
                        ? 'bg-emerald-600 text-white'
                        : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}"
        >
            {{ $cat['label'] }}@if(isset($cat['count'])) {{ $cat['count'] }}@endif
        </button>
    @endforeach
</div>