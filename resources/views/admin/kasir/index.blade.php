{{--
    Halaman "Cashier Staff & Shift Management" — manajemen staf kasir oleh admin.
    Ini beda dari kasir/... (aplikasi POS yang dipakai kasir), folder ini
    khusus admin mengatur data kasirnya.
--}}
@extends('layouts.admin')

@section('title', __('Cashier Staff & Shift Management').' - Admin Matrif')

@section('content')

    @include('admin.kasir.components.staff-breadcrumb')
    @include('admin.kasir.components.staff-header')
    @include('admin.kasir.components.staff-stats')

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="p-5">
            @include('admin.kasir.components.staff-filter')
        </div>
        @include('admin.kasir.components.staff-table')
        @include('admin.kasir.components.pagination')
    </div>

@endsection
