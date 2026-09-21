{{--
    Halaman ini muncul setelah tombol "Complete & Print Receipt" ditekan
    di kasir/transaction/index.blade.php. Idealnya TransactionController@store
    setelah sukses simpan transaksi, redirect ke sini:
    return redirect()->route('kasir.struct.index', $transaction->id);
--}}
@extends('layouts.kasir')

@section('title', __('Transaction Receipt').' - Matrif Fruit POS')

@section('content')

    @include('kasir.struct.components.struct-status')

    <div class="grid grid-cols-1 xl:grid-cols-[1fr_1fr] gap-6 items-start">

        {{-- Kolom kiri: ringkasan transaksi --}}
        @include('kasir.struct.components.transaction-summary')

        {{-- Kolom kanan: aksi cetak + preview struk --}}
        <div class="space-y-4">
            @include('kasir.struct.components.struct-action')
            @include('kasir.struct.components.struct-preview')
        </div>

    </div>

@endsection
