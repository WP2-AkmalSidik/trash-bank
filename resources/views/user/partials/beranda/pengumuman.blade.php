<div class="card-news p-4 mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-dark">Pengumuman Terbaru</h3>
                    <a href="#" class="text-primary text-sm font-medium">Lihat Semua</a>
                </div>

                @if($news->isEmpty())
                    <div class="bg-gray-100 p-4 rounded-lg text-center text-gray-600">
                        Belum ada pengumuman terbaru
                    </div>
                @else
                    @foreach($news as $index => $announcement)
                        <div class="bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/10 p-3 rounded-lg mb-3">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}/20 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $index % 2 == 0 ? 'secondary' : 'primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        @if($index % 2 == 0)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark">{{ $announcement->title }}</h4>
                                    <p class="text-gray-500 text-sm mb-2">{{ Str::limit($announcement->content, 100) }}</p>
                                    <p class="text-xs text-gray-400">Diposting {{ $announcement->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>