@extends('user.layouts.app')

@section('title', 'Transaksi - Bank Sampah')
@section('header', 'Riwayat Transaksi')

@section('content')
    <div id="transaksi-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            @include('user.partials.transaksi.filter-transaksi')
            @include('user.partials.transaksi.list-transaksi')
        </div>
    </div>
@endsection
