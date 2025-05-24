@extends('admin.app')
@section('title', 'Management Residu Sampah')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Filter Card -->
            @include('admin.residu.components.filter-card')

            <!-- Summary Cards -->
            @include('admin.residu.components.summary-card')

            <!-- Search and Actions -->
            @include('admin.residu.components.search-actions')

            <!-- Tabel Residu Sampah -->
            @include('admin.residu.components.residu-table')
        </div>
    </section>

    @include('admin.residu.components.modal-tambah-residu')
    @include('admin.residu.components.modal-edit-residu')
    @include('admin.residu.components.modal-hapus-residu')
    @include('admin.residu.script')
@endsection
