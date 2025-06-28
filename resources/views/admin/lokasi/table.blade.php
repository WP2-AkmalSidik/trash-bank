<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                #</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Nama Lokasi</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Alamat</th>
            <th scope="col"
                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Peta</th>
            <th scope="col"
                class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
        @forelse($locations as $item)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                    {{ ($locations->currentPage() - 1) * $locations->perPage() + $loop->iteration }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                    {{ $item->name }}
                </td>
                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                    {{ $item->address }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                    <button onclick="showMapModal('{{ addslashes($item->url_maps) }}', '{{ addslashes($item->name) }}')"
                        class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                        Lihat Peta
                    </button>
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                    <div class="flex justify-center gap-2">
                        <button data-id="{{ $item->id }}"
                            class="edit-btn p-2 text-blue-600 hover:bg-blue-100/50 dark:text-blue-400 dark:hover:bg-blue-900/50 rounded-full transition-colors duration-200"
                            title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->name) }}')"
                            class="p-2 text-red-600 hover:bg-red-100/50 dark:text-red-400 dark:hover:bg-red-900/50 rounded-full transition-colors duration-200"
                            title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                    Tidak ada lokasi bank sampah ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@if ($locations->hasPages())
    <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="text-sm text-gray-600 dark:text-gray-300">
            Menampilkan
            <span class="font-medium">{{ $locations->firstItem() ?? 0 }}</span>
            sampai
            <span class="font-medium">{{ $locations->lastItem() ?? 0 }}</span>
            dari
            <span class="font-medium">{{ $locations->total() }}</span>
            lokasi
        </div>

        <div class="flex items-center">
            <nav class="flex items-center space-x-1">
                {{ $locations->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </nav>
        </div>
    </div>
@endif

<!-- Map Modal -->
<div id="mapModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full max-w-none">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4" id="mapModalTitle"></h3>
                <div id="mapContainer" class="w-full h-96 bg-gray-100 dark:bg-gray-700 rounded-md overflow-hidden">
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeMapModal()"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fa-solid fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modalTitle">
                            Konfirmasi Hapus
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                Apakah Anda yakin ingin menghapus lokasi <span id="locationName"
                                    class="font-semibold"></span>?
                                Data yang dihapus tidak dapat dikembalikan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="confirmDeleteBtn"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button type="button" onclick="closeDeleteModal()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function showMapModal(iframe, title) {
        const container = $('#mapContainer');
        const mapsUrlMatch = iframe.match(/src="([^"]+)"/);
        const mapsUrl = mapsUrlMatch ? mapsUrlMatch[1] : null;

        let directionUrl = '';
        if (mapsUrl && mapsUrl.includes('@')) {
            const coordMatch = mapsUrl.match(/@([-0-9.]+),([-0-9.]+)/);
            if (coordMatch) {
                const lat = coordMatch[1];
                const lng = coordMatch[2];
                directionUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            }
        }

        const modifiedIframe = iframe.replace('<iframe', '<iframe class="w-full h-full"');
        const mapIframe = `<div class="relative w-full h-full">
        ${modifiedIframe}
        ${iframe}
        ${directionUrl ? `<div class="mt-4 text-center">
            <a href="${directionUrl}" target="_blank" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                Buka Rute di Google Maps
            </a>
        </div>` : ''}
    </div>`;

        $('#mapModalTitle').text(title);
        container.html(mapIframe);
        $('#mapModal').removeClass('hidden');
    }


    function closeMapModal() {
        $('#mapModal').addClass('hidden');
        $('#mapContainer').empty();
    }

    let locationIdToDelete = null;

    function openDeleteModal(id, name) {
        locationIdToDelete = id;
        $('#locationName').text(name);
        $('#deleteModal').removeClass('hidden');
    }

    function closeDeleteModal() {
        locationIdToDelete = null;
        $('#deleteModal').addClass('hidden');
    }

    function deleteLocation() {
        if (!locationIdToDelete) return;

        $.ajax({
            url: `/admin/lokasi/${locationIdToDelete}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                const errorMessage = response?.message || 'Terjadi kesalahan saat menghapus data';

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: errorMessage,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            },
            complete: function() {
                closeDeleteModal();
            }
        });
    }

    $(document).ready(function() {
        $('#confirmDeleteBtn').on('click', deleteLocation);
    });
</script>
