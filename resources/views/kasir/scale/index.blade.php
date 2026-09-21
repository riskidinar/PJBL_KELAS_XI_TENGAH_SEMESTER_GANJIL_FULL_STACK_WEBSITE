@extends('layouts.kasir')

@section('title', __('Scale / Products').' - Matrif Fruit POS')

@section('content')

    @include('kasir.scale.components.scale-header')

    <div class="bg-white rounded-2xl border border-slate-200 p-5 mb-6">
        @include('kasir.scale.components.scale-filter')
        <hr class="border-slate-100 my-4">
        @include('kasir.scale.components.pagination', ['position' => 'top'])
    </div>

    @include('kasir.scale.components.scale-table')

@endsection
