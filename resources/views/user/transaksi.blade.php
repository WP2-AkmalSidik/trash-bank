@extends('user.layouts.app')

@section('title', 'Transaksi - Bank Sampah')
@section('header', 'Riwayat Transaksi')

@section('content')
    <div id="transaksi-page" class="page active">
        @include('user.components.header')

        <div class="p-5">
            <!-- Filter -->
            @include('user.partials.transaksi.filter-transaksi')

            <!-- Simple Loading Indicator -->
            <div id="loading-indicator"
                class="hidden fixed inset-0 z-50 flex items-center justify-center pointer-events-none">
                <div class="animate-spin h-10 w-10 border-4 border-t-transparent rounded-full"
                    style="border-color: #0D723B; border-top-color: transparent;"></div>

            </div>

            <!-- Transaksi List Container -->
            <div id="transactions-container" class="mb-20">
                @include('user.partials.transaksi.list-transaksi', [
                    'groupedTransactions' => $groupedTransactions,
                    'activeFilter' => $activeFilter,
                ])
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const transactionsContainer = document.getElementById('transactions-container');
                const loadingIndicator = document.getElementById('loading-indicator');

                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const filter = this.dataset.filter;

                        // Tampilkan loading indicator
                        loadingIndicator.classList.remove('hidden');
                        // Sembunyikan konten transaksi
                        transactionsContainer.classList.add('opacity-50');

                        // Kirim request AJAX
                        fetch(`/user/transaksi/filter?filter=${filter}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'text/html',
                                }
                            })
                            .then(response => {
                                if (!response.ok) throw new Error('Network response was not ok');
                                return response.text();
                            })
                            .then(html => {
                                // Update konten
                                transactionsContainer.innerHTML = html;

                                // Update active button
                                filterButtons.forEach(btn => {
                                    const isActive = btn.dataset.filter === filter;
                                    btn.classList.toggle('bg-primary', isActive);
                                    btn.classList.toggle('text-white', isActive);
                                    btn.classList.toggle('bg-white', !isActive);
                                    btn.classList.toggle('text-gray-500', !isActive);
                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat memuat data');
                            })
                            .finally(() => {
                                // Sembunyikan loading indicator
                                loadingIndicator.classList.add('hidden');
                                // Tampilkan kembali konten transaksi
                                transactionsContainer.classList.remove('opacity-50');
                            });
                    });
                });
            });
        </script>
    @endpush
@endsection
