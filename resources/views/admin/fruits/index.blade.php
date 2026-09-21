{{--
    Halaman "Fruit Inventory & Stock Management".
    Sidebar & topbar otomatis ikut dari layouts/admin.blade.php.
--}}
@extends('layouts.admin')

@section('title', __('Fruit Inventory & Stock Management').' - Admin Matrif')

@section('content')

    @include('admin.fruits.components.fruit-header')
    @include('admin.fruits.components.fruit-stats')

    <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6">
        @include('admin.fruits.components.fruit-filter')
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        @include('admin.fruits.components.fruit-table')
        @include('admin.fruits.components.pagination')
    </div>

@endsection
