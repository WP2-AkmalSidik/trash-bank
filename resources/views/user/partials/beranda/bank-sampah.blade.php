<div class="mb-20">
    <h3 class="font-bold text-dark text-lg mb-4">Bank Sampah Tasikmalaya</h3>

    @if ($locations->isEmpty())
        <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
            Belum ada lokasi bank sampah
        </div>
    @else
        <div class="space-y-3">
            @foreach ($locations as $location)
                <div
                    class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center hover:shadow-md transition-shadow duration-300">
                    <div>
                        <h4 class="font-medium text-dark mb-1">{{ $location->name }}</h4>
                        <p class="text-gray-500 text-sm">{{ $location->address }}</p>
                    </div>
                    <button
                        onclick="showLocationMap('{{ addslashes($location->url_maps) }}', '{{ addslashes($location->name) }}')"
                        class="bg-primary hover:bg-primary/90 text-white text-sm font-medium rounded px-3 py-1.5 flex items-center gap-1 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Lihat
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>


<!-- Location Map Modal -->
<div id="locationMapModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black/70 transition-opacity backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-lg overflow-hidden shadow-xl transform transition-all w-full max-w-4xl">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button type="button" onclick="closeLocationMap()"
                    class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-4 pt-5 pb-4 sm:p-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 pr-8" id="locationMapTitle"></h3>
                <div id="locationMapContainer" class="w-full h-96 bg-gray-100 rounded-md overflow-hidden"></div>
                <div id="locationDirections" class="mt-4 text-center"></div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeLocationMap()"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showLocationMap(iframe, title) {
        const container = document.getElementById('locationMapContainer');
        const directionsContainer = document.getElementById('locationDirections');
        const mapsUrlMatch = iframe.match(/src="([^"]+)"/);
        const mapsUrl = mapsUrlMatch ? mapsUrlMatch[1] : null;

        let directionUrl = '';
        if (mapsUrl && mapsUrl.includes('!3d')) {
            // Extract coordinates from Google Maps embed URL
            const latMatch = mapsUrl.match(/!3d([-0-9.]+)/);
            const lngMatch = mapsUrl.match(/!4d([-0-9.]+)/);

            if (latMatch && lngMatch) {
                const lat = latMatch[1];
                const lng = lngMatch[1];
                directionUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            }
        } else if (mapsUrl && mapsUrl.includes('@')) {
            // Alternative coordinate extraction
            const coordMatch = mapsUrl.match(/@([-0-9.]+),([-0-9.]+)/);
            if (coordMatch) {
                const lat = coordMatch[1];
                const lng = coordMatch[2];
                directionUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            }
        }

        // Handle iframe content directly
        container.innerHTML = '';
        const mapFrame = document.createElement('iframe');
        mapFrame.setAttribute('src', mapsUrl);
        mapFrame.setAttribute('width', '100%');
        mapFrame.setAttribute('height', '100%');
        mapFrame.setAttribute('style', 'border:0;');
        mapFrame.setAttribute('allowfullscreen', '');
        mapFrame.setAttribute('loading', 'lazy');
        mapFrame.setAttribute('referrerpolicy', 'no-referrer-when-downgrade');
        container.appendChild(mapFrame);

        if (directionUrl) {
            directionsContainer.innerHTML = `
            <a href="${directionUrl}" target="_blank" class="inline-flex items-center bg-primary hover:bg-primary/90 text-white font-medium px-4 py-2 rounded-md transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
                Buka Rute di Google Maps
            </a>
        `;
        } else {
            directionsContainer.innerHTML = '';
        }

        document.getElementById('locationMapTitle').textContent = title;
        document.getElementById('locationMapModal').classList.remove('hidden');
    }

    function closeLocationMap() {
        document.getElementById('locationMapModal').classList.add('hidden');
        document.getElementById('locationMapContainer').innerHTML = '';
        document.getElementById('locationDirections').innerHTML = '';
    }
</script>
