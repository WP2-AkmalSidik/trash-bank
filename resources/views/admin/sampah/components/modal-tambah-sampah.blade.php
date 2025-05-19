<div id="addWasteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Jenis Sampah</h3>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <form id="addWasteForm" class="p-5">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Jenis Sampah <span class="text-red-500">*</span></label>
                <input type="text" id="add_name" name="name" required 
                    class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                    placeholder="Contoh: Plastik, Kertas, Besi">
            </div>
            
            <div class="mb-4">
                <label for="price_per_kg" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga per Kg (Rp) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500 dark:text-gray-400">Rp</span>
                    </div>
                    <input type="number" id="add_price_per_kg" name="price_per_kg" required min="0" step="0.01"
                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 focus:ring-primary focus:border-primary focus:outline-none bg-white dark:bg-gray-700 text-gray-800 dark:text-white"
                        placeholder="0.00">
                </div>
            </div>
            
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeAddModal()" 
                    class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit" 
                    class="px-4 py-2 rounded-lg bg-primary text-secondary hover:bg-opacity-90 transition flex items-center justify-center">
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>