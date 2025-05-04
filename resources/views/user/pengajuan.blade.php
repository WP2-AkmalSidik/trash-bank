@extends('user.layouts.app')

@section('title', 'Pengajuan - Bank Sampah')
@section('header', 'Pengajuan Tarik Dana')

@section('content')
    <div id="pengajuan-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            @include('user.partials.pengajuan.status-pengajuan')

            <button class="w-full bg-primary text-white font-medium py-3 rounded-xl mb-6 shadow-md">Ajukan Penarikan
                Dana</button>

            @include('user.partials.pengajuan.riwayat-pengajuan')
        </div>
    </div>
@endsection
