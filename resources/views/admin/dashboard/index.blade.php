@extends('layouts.admin')

@section('title', __('Admin Dashboard').' - Matrif Fruit POS')

@section('content')
    @include('admin.dashboard.components.page-header')

    @include('admin.dashboard.components.stat-card')

    <div class="grid grid-cols-1 gap-6 2xl:grid-cols-[minmax(0,1.6fr)_minmax(360px,1fr)]">
        @include('admin.dashboard.components.hourly-income')
        @include('admin.dashboard.components.top-mover')
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
        @include('admin.dashboard.components.cricital-inventory')
        @include('admin.dashboard.components.cashier-performance')
    </div>
@endsection
