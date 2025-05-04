@extends('user.layouts.app')

@section('title', 'Profil - Bank Sampah')
@section('header', 'Profil Saya')

@section('content')
    <div id="profil-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            @include('user.partials.profile.profile-info')
            @include('user.partials.profile.informasi-pribadi')
            @include('user.partials.profile.informasi-rekening')
            @include('user.partials.profile.rekening-ewallet')
            @include('user.partials.profile.pengaturan-logout')
        </div>
    </div>
@endsection
