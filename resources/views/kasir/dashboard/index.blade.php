@extends('layouts.kasir')

@section('title', __('Dashboard').' - Matrif Fruit POS')

@section('content')
    @include('kasir.dashboard.components.page-header')

    @include('kasir.dashboard.components.stat-card')

    <div class="grid grid-cols-1 gap-6 2xl:grid-cols-[minmax(0,1.6fr)_minmax(360px,1fr)]">
        @include('kasir.dashboard.components.hourly-income')
        @include('kasir.dashboard.components.top-mover')
    </div>
@endsection
