<div class="mb-20">
    <h3 class="font-bold text-dark mb-3">Lokasi Bank Sampah</h3>

    @if ($locations->isEmpty())
        <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
            Belum ada lokasi bank sampah
        </div>
    @else
        @foreach ($locations as $location)
            <div class="bg-white rounded-lg shadow-sm p-3 mb-3">
                <h4 class="font-medium text-dark mb-1">{{ $location->name }}</h4>
                <p class="text-gray-500 text-sm">{{ $location->address }}</p>
            </div>
        @endforeach
    @endif
</div>
