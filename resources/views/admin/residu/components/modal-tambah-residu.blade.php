<div id="addResiduModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md mx-4">
        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tambah Residu Sampah</h3>
            
            <form id="addResiduForm">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Residu
                    </label>
                    <input type="text" id="name" name="name" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-primary focus:border-primary" 
                        required>
                </div>
                
                <div class="mb-4">
                    <label for="weight_kg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Berat (kg)
                    </label>
                    <input type="number" id="weight_kg" name="weight_kg" step="0.01" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-primary focus:border-primary" 
                        required>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-primary rounded-lg hover:bg-opacity-90">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>