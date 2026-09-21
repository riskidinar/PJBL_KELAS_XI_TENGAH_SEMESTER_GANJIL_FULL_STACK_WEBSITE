{{--
    Halaman ini HANYA berisi konten (sisi kiri + kanan).
    Sidebar & topbar otomatis ikut karena @extends('layouts.kasir').
--}}
@extends('layouts.kasir')

@section('title', __('POS / Transactions').' - Matrif Fruit POS')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-[1fr_380px] gap-6 items-start">

    {{-- Kolom kiri: pencarian, filter kategori, grid produk --}}
    <div class="space-y-4">
        @include('kasir.transaction.components.search-bar')
        @include('kasir.transaction.components.category-filter', ['categories' => $categories ?? null])
        @include('kasir.transaction.components.product-grid', ['products' => $products ?? null])
    </div>

    {{-- Kolom kanan: keranjang transaksi berjalan --}}
    <div class="sticky top-0">
        @include('kasir.transaction.components.current-transaction', ['cart' => $cart ?? null])
    </div>

</div>
@endsection
