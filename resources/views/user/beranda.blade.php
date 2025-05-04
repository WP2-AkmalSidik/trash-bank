@extends('user.layouts.app')

@section('title', 'Beranda - Bank Sampah')

@section('content')
    <div id="beranda-page" class="page active">
        @include('user.components.wave-header')
        <div class="px-5 pt-20">
            @include('user.partials.beranda.harga-sampah')
            @include('user.partials.beranda.pengumuman')
            @include('user.partials.beranda.transaksi-terakhir')
        </div>
    </div>
@endsection
