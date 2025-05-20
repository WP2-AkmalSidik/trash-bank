@extends('admin.app')
@section('title', 'Pengajuan Penarikan Saldo')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md min-h-[calc(100vh-8rem)] p-4 md:p-6">
        <div class="mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">list Pengajuan</h1>

                <!-- Filter Controls -->
                @include('admin.pengajuan.filter')
            </div>

            <!-- Withdrawal Table -->
            @include('admin.pengajuan.table')

            <!-- Pagination -->
            <div class="px-4 py-3 border-t dark:border-gray-700">
                {{ $withdrawals->links() }}
            </div>
        </div>
    </section>

    <!-- Proof of Transfer Upload Modal -->
    <div id="proofUploadModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6 relative">
            <button onclick="closeModal('proofUploadModal')"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Upload Bukti Transfer</h3>

            <form id="proofUploadForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="withdrawal_id" name="withdrawal_id">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih File Bukti
                        Transfer</label>
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg px-6 pt-5 pb-6 cursor-pointer"
                        id="dropzone">
                        <input id="proof_file" name="proof_file" type="file" accept="image/*" class="hidden">
                        <div class="space-y-1 text-center" id="upload-prompt">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <label for="proof_file"
                                    class="cursor-pointer text-blue-600 dark:text-blue-400 hover:underline">
                                    <span>Pilih file</span>
                                </label>
                                <span> atau seret dan letakkan di sini</span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PNG, JPG, JPEG (Maks. 2MB)
                            </p>
                        </div>
                        <div class="hidden" id="image-preview-container">
                            <img id="image-preview" class="mx-auto max-h-48 rounded" src="" alt="Preview">
                            <p class="text-center text-sm mt-2 text-gray-600 dark:text-gray-400" id="file-name"></p>
                            <button type="button"
                                class="mt-2 text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 underline"
                                id="remove-file">
                                Hapus & Pilih File Lain
                            </button>
                        </div>
                    </div>
                    <div id="file-error" class="text-red-500 text-xs mt-1 hidden"></div>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('proofUploadModal')"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 mr-3">
                        Batal
                    </button>
                    <button type="button" onclick="uploadProofOfTransfer()"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
                        Upload Bukti
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Proof of Transfer View Modal -->
    <div id="proofViewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-2xl w-full p-6 relative">
            <button onclick="closeModal('proofViewModal')"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Bukti Transfer</h3>

            <div class="flex justify-center">
                <img id="proof-image" class="max-h-96 rounded shadow-lg" src="" alt="Bukti Transfer">
            </div>

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal('proofViewModal')"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    @include('admin.pengajuan.script')
@endsection
