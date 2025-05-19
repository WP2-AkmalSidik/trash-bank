<div class="card-price p-4 mb-6 bg-white rounded-xl shadow">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-bold text-dark">Harga Sampah Terkini</h3>
    </div>

    <div class="overflow-x-auto scrollbar-hide -mx-1">
        <div class="flex space-x-3 px-1 pb-2">
            @foreach ($wasteTypes as $index => $wasteType)
                @php
                    // Set different icons based on waste type name
                    $icons = [
                        'paper' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />',
                        'plastic' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />',
                        'bottle' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />',
                        'can' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
                    ];
                    $icon = $icons['paper']; // Default icon
                    $name = strtolower($wasteType->name);

                    if (strpos($name, 'kertas') !== false || strpos($name, 'paper') !== false) {
                        $icon = $icons['paper'];
                    } elseif (strpos($name, 'plastik') !== false || strpos($name, 'plastic') !== false) {
                        $icon = $icons['plastic'];
                    } elseif (strpos($name, 'botol') !== false || strpos($name, 'bottle') !== false) {
                        $icon = $icons['bottle'];
                    } elseif (strpos($name, 'kaleng') !== false || strpos($name, 'can') !== false) {
                        $icon = $icons['can'];
                    }
                @endphp

                <div class="mini-card p-3 w-32 flex-shrink-0">
                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            {!! $icon !!}
                        </svg>
                    </div>
                    <p class="text-xs text-gray-500">{{ $wasteType->name }}</p>
                    <p class="font-bold text-dark">Rp {{ number_format($wasteType->price_per_kg, 0, ',', '.') }}<span
                            class="text-xs font-normal">/kg</span></p>

                    <!-- Persentase perubahan harga -->
                    <div class="flex items-center mt-1">
                        @if ($wasteType->is_increase)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 15l7-7 7 7" />
                            </svg>
                            <span class="text-xs text-green-500 ml-1">+{{ abs($wasteType->price_change) }}%</span>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="text-xs text-red-500 ml-1">-{{ abs($wasteType->price_change) }}%</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
