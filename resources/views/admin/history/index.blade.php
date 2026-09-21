{{--
    Halaman ini menyusun komponen "Transaction History & Audit Logs" versi Admin.
    Beda dari versi kasir: ada breadcrumb, status semua register, filter lebih
    lengkap (Register/Cashier/Payment/Status), dan tombol Import CSV.
--}}
@extends('layouts.admin')

@section('title', __('Transaction History & Audit Logs').' - Admin Matrif')

@section('content')

    @include('admin.history.components.history-breadcrumb')
    @include('admin.history.components.history-header')

    <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6">
        @include('admin.history.components.history-filter')
    </div>

    @include('admin.history.components.transaction-table')

    <div class="mt-4">
        @include('admin.history.components.pagination')
    </div>

@endsection
