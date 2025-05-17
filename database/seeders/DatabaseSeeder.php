<?php

namespace Database\Seeders;

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

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin TrashBank',
            'email' => 'admin@trashbank.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '081234567890',
        ]);

        // Member
        $member = User::create([
            'name' => 'Akmal',
            'email' => 'akml@trashbank.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone_number' => '082345678901',
        ]);

        // Member Account
        $account = MemberAccount::create([
            'user_id' => $member->id,
            'account_number' => 'MBR-' . Str::random(6),
        ]);

        // Waste Types
        $plastic = WasteType::create(['name' => 'Plastik', 'price_per_kg' => 1500]);
        $paper = WasteType::create(['name' => 'Kertas', 'price_per_kg' => 1200]);

        // Deposit
        Deposit::create([
            'member_account_id' => $account->id,
            'waste_type_id' => $plastic->id,
            'weight_kg' => 2.5,
            'total_price' => 2.5 * 1500,
        ]);

        // Withdrawal (Pending)
        Withdrawal::create([
            'member_account_id' => $account->id,
            'amount' => 2000,
            'method' => 'ewallet',
            'ewallet_type' => 'OVO',
            'ewallet_number' => '081234567890',
            'status' => 'pending',
        ]);

        // News
        News::create([
            'title' => 'Bank Sampah Dibuka!',
            'content' => 'Kami membuka bank sampah untuk masyarakat sekitar mulai bulan ini.'
        ]);

        // Locations
        Location::create([
            'name' => 'Bank Sampah Utama',
            'address' => 'Jl. Contoh No. 123, Tasikmalaya',
            'url_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31654.65020276018!2d108.22942719999999!3d-7.372799999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f578ee32cbd6d%3A0xa9906e898f20b776!2sUniversitas%20Muhammadiyah%20Tasikmalaya!5e0!3m2!1sid!2sid!4v1746580937204!5m2!1sid!2sid',
        ]);
    }
}
