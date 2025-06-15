<div class="card-news p-4 mb-6">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-bold text-dark">Pengumuman Terbaru</h3>
    </div>

    @if ($news->isEmpty())
        <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
            Belum ada pengumuman terbaru
        </div>
    @else
        @foreach ($news as $index => $announcement)
            <div class="bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/10 p-3 rounded-lg mb-3">
                <div class="flex items-start">
                    <div
                        class="w-10 h-10 bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/20 rounded-full flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            @if ($index % 2 == 0)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            @endif
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="font-semibold text-dark truncate max-w-[190px]"
                                title="{{ $announcement->title }}">
                                {{ Str::limit($announcement->title, 30) }}
                            </h4>
                            <button onclick="showAnnouncementDetail({{ $announcement->id }})"
                                class="bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }} hover:bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/90 text-white text-sm font-medium rounded px-3 py-1.5 flex items-center gap-1 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Lihat
                            </button>
                        </div>
                        <p class="text-gray-500 text-sm mb-2">{{ Str::limit($announcement->content, 50) }}</p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $announcement->created_at->locale('id')->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<!-- Modal for detail pengumuman (light mode only) -->
<div id="announcementModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-[100] hidden backdrop-blur-sm">
    <div class="absolute inset-0" onclick="closeModal()"></div>

    <div class="relative bg-white rounded-t-2xl rounded-b-lg shadow-xl max-w-2xl w-full mx-4 mb-4 max-h-[90vh] flex flex-col z-10">
        <!-- Header with close button -->
        <div class="sticky top-0 bg-white rounded-t-2xl p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold text-dark"></h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Scrollable content -->
        <div class="overflow-y-auto flex-1 p-4">
            <div id="modalContent" class="text-gray-700 mb-4 whitespace-pre-line"></div>
        </div>
        
        <!-- Footer with date -->
        <div class="sticky bottom-0 bg-white p-4 border-t border-gray-200">
            <div id="modalDate" class="text-sm text-gray-500"></div>
        </div>
    </div>
</div>

<script>
    function showAnnouncementDetail(id) {
        // Show loading overlay
        document.getElementById('loading-overlay').classList.remove('hidden');

        // Disable body scroll
        document.body.style.overflow = 'hidden';

        // Fetch data pengumuman via AJAX
        fetch(`/user/announcement/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Hide loading overlay
                document.getElementById('loading-overlay').classList.add('hidden');

                // Populate modal with data
                document.getElementById('modalTitle').textContent = data.title;
                document.getElementById('modalContent').textContent = data.content;
                document.getElementById('modalDate').textContent = 'Diposting: ' + new Date(data.created_at)
                    .toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                // Show modal
                document.getElementById('announcementModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                // Hide loading overlay on error too
                document.getElementById('loading-overlay').classList.add('hidden');
                document.body.style.overflow = 'auto';
                alert('Gagal memuat detail pengumuman');
            });
    }

    function closeModal() {
        document.getElementById('announcementModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Tutup modal saat klik di luar konten modal atau tekan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
