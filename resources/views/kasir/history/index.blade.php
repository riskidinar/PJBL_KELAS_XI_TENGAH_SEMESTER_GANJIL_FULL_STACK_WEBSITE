{{--
    Halaman ini hanya menyusun urutan komponen "Transaction History & Audit Logs".
    Sidebar & topbar otomatis ikut dari layouts/kasir.blade.php.
--}}
@extends('layouts.kasir')

@section('title', __('Transaction History').' - Matrif Fruit POS')

@section('content')

    @include('kasir.history.components.history-header')

    <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6">
        @include('kasir.history.components.history-filter')
    </div>

    @include('kasir.history.components.transaction-table')

    <div class="mt-4">
        @include('kasir.history.components.pagination')
    </div>

@endsection
