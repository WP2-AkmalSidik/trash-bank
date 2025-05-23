<?php

namespace Database\Seeders;

use App\Models\Residue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\WasteType;
use App\Models\MemberAccount;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\News;
use App\Models\Location;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seeder untuk Admin
        $this->seedAdmin();
        
        // 2. Seeder untuk Member
        $members = $this->seedMembers();
        
        // 3. Seeder untuk Jenis Sampah
        $wasteTypes = $this->seedWasteTypes();
        
        // 4. Seeder untuk Akun Member
        $memberAccounts = $this->seedMemberAccounts($members);
        
        // 5. Seeder untuk Deposit
        $this->seedDeposits($memberAccounts, $wasteTypes);
        
        // 6. Seeder untuk Penarikan
        $this->seedWithdrawals($memberAccounts);
        
        // 7. Seeder untuk Berita
        $this->seedNews();
        
        // 8. Seeder untuk Residu
        $this->seedResidue();
        
        // 8. Seeder untuk Lokasi
        $this->seedLocations();
    }

    private function seedAdmin(): void
    {
        User::create([
            'name' => 'Admin TrashBank',
            'email' => 'admin@trashbank.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '081234567890',
        ]);
    }

    private function seedMembers(): array
    {
        $members = [
            [
                'name' => 'Akmal Fauzi',
                'email' => 'akmal@trashbank.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone_number' => '082345678901',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@trashbank.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone_number' => '083456789012',
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra@trashbank.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone_number' => '084567890123',
            ],
            [
                'name' => 'Doni Pratama',
                'email' => 'doni@trashbank.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone_number' => '085678901234',
            ],
            [
                'name' => 'Eka Putri',
                'email' => 'eka@trashbank.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone_number' => '086789012345',
            ],
        ];

        $createdMembers = [];
        foreach ($members as $member) {
            $createdMembers[] = User::create($member);
        }

        return $createdMembers;
    }

    private function seedWasteTypes(): array
    {
        $wasteTypes = [
            ['name' => 'Botol Plastik', 'price_per_kg' => 5000],
            ['name' => 'Kardus', 'price_per_kg' => 3000],
            ['name' => 'Kaleng Aluminium', 'price_per_kg' => 8000],
            ['name' => 'Botol Kaca', 'price_per_kg' => 2000],
            ['name' => 'Kertas', 'price_per_kg' => 2500],
            ['name' => 'Sampah Elektronik', 'price_per_kg' => 10000],
            ['name' => 'Besi Bekas', 'price_per_kg' => 7000],
        ];

        $createdWasteTypes = [];
        foreach ($wasteTypes as $type) {
            $createdWasteTypes[] = WasteType::create($type);
        }

        return $createdWasteTypes;
    }

    private function seedMemberAccounts(array $members): array
    {
        $memberAccounts = [];
        foreach ($members as $index => $member) {
            $accountNumber = 'BS' . str_pad($index + 1, 5, '0', STR_PAD_LEFT);
            
            $memberAccounts[] = MemberAccount::create([
                'user_id' => $member->id,
                'account_number' => $accountNumber,
                'balance' => 0,
            ]);
        }

        return $memberAccounts;
    }

    private function seedDeposits(array $memberAccounts, array $wasteTypes): void
    {
        foreach ($memberAccounts as $account) {
            $depositCount = rand(3, 10);
            
            for ($i = 0; $i < $depositCount; $i++) {
                $wasteType = $wasteTypes[array_rand($wasteTypes)];
                $weight = rand(1, 50) / 10; // Berat antara 0.1 dan 5.0 kg
                $totalPrice = $weight * $wasteType->price_per_kg;

                $deposit = Deposit::create([
                    'member_account_id' => $account->id,
                    'waste_type_id' => $wasteType->id,
                    'weight_kg' => $weight,
                    'price_per_kg' => $wasteType->price_per_kg,
                    'total_price' => $totalPrice,
                    'created_at' => Carbon::now()->subDays(rand(0, 90)),
                ]);

                // Update saldo akun
                $account->balance += $totalPrice;
                $account->save();
            }
        }
    }

    private function seedWithdrawals(array $memberAccounts): void
    {
        foreach ($memberAccounts as $account) {
            if (rand(0, 1)) {
                $withdrawalCount = rand(1, 3);
                
                for ($i = 0; $i < $withdrawalCount; $i++) {
                    $amount = rand(10000, 50000);
                    $statuses = ['pending', 'approved', 'rejected'];
                    $status = $statuses[array_rand($statuses)];
                    $method = rand(0, 1) ? 'cash' : 'ewallet';
                    
                    $withdrawalData = [
                        'member_account_id' => $account->id,
                        'amount' => $amount,
                        'method' => $method,
                        'status' => $status,
                        'rejection_reason' => $status === 'rejected' ? 'Dokumen tidak lengkap' : null,
                        'created_at' => Carbon::now()->subDays(rand(0, 30)),
                    ];
                    
                    if ($method === 'ewallet') {
                        $ewalletTypes = ['OVO', 'GoPay', 'Dana', 'ShopeePay'];
                        $withdrawalData['ewallet_type'] = $ewalletTypes[array_rand($ewalletTypes)];
                        $withdrawalData['ewallet_number'] = '08' . rand(100000000, 999999999);
                    }

                    $withdrawal = Withdrawal::create($withdrawalData);

                    if ($status === 'approved' && $account->hasSufficientBalance($amount)) {
                        $account->balance -= $amount;
                        $account->save();
                    }
                }
            }
        }
    }

    private function seedNews(): void
    {
        $newsItems = [
            [
                'title' => 'Program Baru: Tabungan Sampah Digital',
                'content' => 'TrashBank kini menghadirkan program tabungan sampah digital yang memudahkan nasabah untuk menabung dan menarik dana kapan saja.',
            ],
            [
                'title' => 'Harga Jenis Sampah Terbaru',
                'content' => 'Perubahan harga beberapa jenis sampah efektif mulai bulan depan. Silakan cek daftar harga terbaru di aplikasi kami.',
            ],
            [
                'title' => 'Lokasi Baru di Kota Bandung',
                'content' => 'Kami dengan bangga mengumumkan pembukaan lokasi baru di Jalan Merdeka No. 123, Bandung. Datang dan kunjungi kami!',
            ],
            [
                'title' => 'Tips Memilah Sampah Rumah Tangga',
                'content' => 'Pelajari cara memilah sampah rumah tangga dengan benar untuk meningkatkan nilai ekonomis sampah Anda.',
            ],
        ];

        foreach ($newsItems as $news) {
            News::create($news);
        }
    }

    private function seedLocations(): void
    {
        $locations = [
            [
                'name' => 'TrashBank Pusat',
                'address' => 'Jl. Siliwangi No. 45, Tasikmalaya',
                'url_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31654.65020276018!2d108.23270399999998!3d-7.372799999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5817bf80530b%3A0x170d075986c8ed42!2sUniversitas%20Siliwangi%20-%20Kampus%202%20Mugarsari!5e0!3m2!1sid!2sid!4v1747981956005!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            ],
            [
                'name' => 'TrashBank Cabang Bandung',
                'address' => 'Jl. Merdeka No. 123, Bandung',
                'url_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7861516356934!2d107.6181064!3d-6.9175809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62b9c5b5b5b%3A0x5b5b5b5b5b5b5b5b!2sJl.%20Merdeka%20No.123%2C%20Bandung!5e0!3m2!1sid!2sid!4v1747981956005!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            ],
            [
                'name' => 'TrashBank Cabang Jakarta',
                'address' => 'Jl. Sudirman No. 456, Jakarta',
                'url_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7861516356934!2d106.8181064!3d-6.2175809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3b5b5b5b5b5%3A0x5b5b5b5b5b5b5b5b!2sJl.%20Sudirman%20No.456%2C%20Jakarta!5e0!3m2!1sid!2sid!4v1747981956005!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
    private function seedResidue(): void
    {
        $residueItem = [
            [
                'name' => 'Sampah Pelastik',
                'weight_kg' => 0.5,
            ],
            [
                'name' => 'Sampah Kertas',
                'weight_kg' => 0.5,
            ],
            [
                'name' => 'Sampah Kardus',
                'weight_kg' => 2.5,
            ],
            [
                'name' => 'Sampah Kaca',
                'weight_kg' => 0.5,
            ],
        ];

        foreach ($residueItem as $res) {
            Residue::create($res);
        }
    }
}