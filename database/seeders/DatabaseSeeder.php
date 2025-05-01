<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WasteType;
use App\Models\MemberAccount;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\News;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk User (Admin dan Member)
        $admin = User::create([
            'name' => 'Admin TrashBank',
            'email' => 'admin@trashbank.com',
            'password' => bcrypt('password123'),
            'phone_number' => '081234567890',
            'role' => 'admin',
        ]);

        $member = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'phone_number' => '081234567890',
            'role' => 'member',
        ]);

        // Seeder untuk MemberAccount (Akun Member)
        $memberAccount1 = MemberAccount::create([
            'user_id' => $member->id,
            'account_number' => 'MBR0001',
            'opened_at' => now(),
        ]);

        // Seeder untuk WasteTypes (Jenis Sampah)
        $wasteType1 = WasteType::create([
            'name' => 'Plastic',
            'price_per_kg' => 5000.00, // Harga per kilogram
        ]);

        $wasteType2 = WasteType::create([
            'name' => 'Glass',
            'price_per_kg' => 8000.00, // Harga per kilogram
        ]);

        // Seeder untuk Deposit (Setoran Sampah)
        Deposit::create([
            'member_account_id' => $memberAccount1->id,
            'waste_type_id' => $wasteType1->id,
            'weight_kg' => 10,
            'total_price' => 50000.00,
            'deposited_at' => now(),
        ]);

        // Seeder untuk Withdrawal (Penarikan)
        Withdrawal::create([
            'member_account_id' => $memberAccount1->id,
            'amount' => 100000,
            'method' => 'ewallet',
            'ewallet_type' => 'GoPay',
            'ewallet_number' => '08123456789',
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        // Seeder untuk News (Pengumuman)
        News::create([
            'title' => 'Important Update: New Location Opened',
            'content' => 'We have opened a new Trash Bank location in the downtown area. Visit us today!',
        ]);

        // Seeder untuk Locations (Lokasi Bank Sampah)
        Location::create([
            'name' => 'Trash Bank Downtown',
            'address' => 'Jl. Downtown No. 15, City Center',
        ]);
    }
}
