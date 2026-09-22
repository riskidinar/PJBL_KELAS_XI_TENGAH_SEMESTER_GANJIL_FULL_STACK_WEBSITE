@php
    $products = $products ?? [];
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @forelse ($products as $product)
        @include('kasir.transaction.components.product-card', ['product' => $product])
    @empty
        <p class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white py-10 text-center text-sm text-slate-400">
            {{ __('Belum ada data buah di katalog.') }}
        </p>
    @endforelse
</div>
