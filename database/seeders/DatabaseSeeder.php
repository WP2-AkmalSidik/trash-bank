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
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin TrashBank',
            'email' => 'admin@trashbank.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '081234567890',
        ]);

        // Create Members
        $members = [
            [
                'name' => 'Akmal',
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

        // Create Waste Types
        $wasteTypes = [
            ['name' => 'Plastic Bottles', 'price_per_kg' => 5000],
            ['name' => 'Cardboard', 'price_per_kg' => 3000],
            ['name' => 'Aluminum Cans', 'price_per_kg' => 8000],
            ['name' => 'Glass Bottles', 'price_per_kg' => 2000],
            ['name' => 'Paper', 'price_per_kg' => 2500],
            ['name' => 'Electronic Waste', 'price_per_kg' => 10000],
            ['name' => 'Metal Scraps', 'price_per_kg' => 7000],
        ];

        $createdWasteTypes = [];
        foreach ($wasteTypes as $type) {
            $createdWasteTypes[] = WasteType::create($type);
        }

        // Create Member Accounts
        foreach ($createdMembers as $member) {
            $account = MemberAccount::create([
                'user_id' => $member->id,
                'account_number' => 'TB' . str_pad($member->id, 6, '0', STR_PAD_LEFT),
                'balance' => 0,
            ]);

            // Create deposits for each member
            $depositCount = rand(3, 10);
            for ($i = 0; $i < $depositCount; $i++) {
                $wasteType = $createdWasteTypes[array_rand($createdWasteTypes)];
                $weight = rand(1, 50) / 10; // Random weight between 0.1 and 5.0 kg
                $totalPrice = $weight * $wasteType->price_per_kg;

                $deposit = Deposit::create([
                    'member_account_id' => $account->id,
                    'waste_type_id' => $wasteType->id,
                    'weight_kg' => $weight,
                    'price_per_kg' => $wasteType->price_per_kg,
                    'total_price' => $totalPrice,
                    'created_at' => Carbon::now()->subDays(rand(0, 90)),
                ]);

                // Update account balance
                $account->balance += $totalPrice;
            }

            // Create withdrawals for some members
            if (rand(0, 1)) {
                $withdrawalCount = rand(1, 3);
                for ($i = 0; $i < $withdrawalCount; $i++) {
                    $amount = rand(10000, 50000);
                    $statuses = ['pending', 'approved', 'rejected'];
                    $status = $statuses[array_rand($statuses)];
                    
                    // Use only 'cash' or 'ewallet' as method values
                    $method = rand(0, 1) ? 'cash' : 'ewallet';
                    
                    $withdrawalData = [
                        'member_account_id' => $account->id,
                        'amount' => $amount,
                        'method' => $method,
                        'status' => $status,
                        'rejection_reason' => $status === 'rejected' ? 'Insufficient documentation' : null,
                        'created_at' => Carbon::now()->subDays(rand(0, 30)),
                    ];
                    
                    // Only add e-wallet details if method is ewallet
                    if ($method === 'ewallet') {
                        $ewalletTypes = ['OVO', 'GoPay', 'Dana', 'ShopeePay'];
                        $withdrawalData['ewallet_type'] = $ewalletTypes[array_rand($ewalletTypes)];
                        $withdrawalData['ewallet_number'] = '08' . rand(100000000, 999999999);
                    }

                    $withdrawal = Withdrawal::create($withdrawalData);

                    if ($status === 'approved' && $account->hasSufficientBalance($amount)) {
                        $account->balance -= $amount;
                    }
                }
            }

            $account->save();
        }
    }
}