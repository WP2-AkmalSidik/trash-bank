<div id="deleteResiduModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-900">
                <i class="fa-solid fa-exclamation text-red-600 dark:text-red-300 text-xl"></i>
            </div>
            
            <h3 class="text-lg font-bold text-center text-gray-900 dark:text-white mb-2">Konfirmasi Hapus</h3>
            <p id="delete-confirmation-text" class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6"></p>
            
            <div class="flex justify-center gap-3">
                <button id="cancel-delete-btn" type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button id="confirm-delete-btn" type="button"
                    class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                    <span id="delete-loading" class="hidden">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                    </span>
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>