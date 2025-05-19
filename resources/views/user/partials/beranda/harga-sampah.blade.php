<div class="card-price p-4 mb-6 bg-white rounded-xl shadow">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-bold text-dark">Harga Sampah Terkini</h3>
    </div>

    <div class="overflow-x-auto scrollbar-hide -mx-1">
        <div class="flex space-x-3 px-1 pb-2">
            @foreach ($wasteTypes as $index => $wasteType)
                @php
                    $wasteIcons = [
                        'kertas' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
                            'color' => 'text-blue-500',
                        ],
                        'plastik' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />',
                            'color' => 'text-yellow-500',
                        ],
                        'botol' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />',
                            'color' => 'text-green-500',
                        ],
                        'kaleng' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />',
                            'color' => 'text-gray-500',
                        ],
                        'logam' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />',
                            'color' => 'text-orange-500',
                        ],
                        'kaca' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />',
                            'color' => 'text-cyan-500',
                        ],
                        'organik' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />',
                            'color' => 'text-brown-500',
                        ],
                        'elektronik' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />',
                            'color' => 'text-purple-500',
                        ],
                        'baterai' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M21 10.5h.375c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125H21M4.5 10.5h6.75V15H4.5v-4.5zM3.75 18h15A2.25 2.25 0 0021 15.75v-6a2.25 2.25 0 00-2.25-2.25h-15A2.25 2.25 0 001.5 9.75v6A2.25 2.25 0 003.75 18z" />',
                            'color' => 'text-red-500',
                        ],
                        'tekstil' => [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M21 12v7.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V12m18-3H3m18 3h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l-1 3m-8.5-3l1-3" />',
                            'color' => 'text-pink-500',
                        ],
                    ];

                    // Mapping nama sampah ke kategori icon
                    $wasteCategories = [
                        'kertas' => ['kertas', 'paper', 'koran', 'kardus'],
                        'plastik' => ['plastik', 'plastic', 'kresek'],
                        'botol' => ['botol', 'bottle', 'gelas'],
                        'kaleng' => ['kaleng', 'can', 'aluminium'],
                        'logam' => ['besi', 'logam', 'metal', 'tembaga'],
                        'kaca' => ['kaca', 'glass', 'beling'],
                        'organik' => ['organik', 'sisa makanan', 'daun'],
                        'elektronik' => ['elektronik', 'baterai', 'hp', 'laptop'],
                        'baterai' => ['baterai', 'aki', 'accu'],
                        'tekstil' => ['tekstil', 'kain', 'baju', 'pakaian'],
                    ];

                    $matchedCategory = 'plastik';
                    $nameLower = strtolower($wasteType->name);

                    foreach ($wasteCategories as $category => $keywords) {
                        foreach ($keywords as $keyword) {
                            if (str_contains($nameLower, $keyword)) {
                                $matchedCategory = $category;
                                break 2;
                            }
                        }
                    }

                    $selectedIcon = $wasteIcons[$matchedCategory] ?? $wasteIcons['plastik'];
                @endphp

                <div class="mini-card p-3 w-32 flex-shrink-0">
                    <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $selectedIcon['color'] }}" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            {!! $selectedIcon['icon'] !!}
                        </svg>
                    </div>
                    <p class="text-xs text-gray-500">{{ $wasteType->name }}</p>
                    <p class="font-bold text-dark">Rp {{ number_format($wasteType->price_per_kg, 0, ',', '.') }}<span
                            class="text-xs font-normal">/kg</span></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
