<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        \App\Models\User::create([
            'name' => 'Jason Doe',
            'email' => 'admin@finance.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
            'full_name' => 'Jason Doe',
            'phone' => '+62812345678',
        ]);

        // Create Finance Users
        \App\Models\User::create([
            'name' => 'Pras Teguh',
            'email' => 'prasteguh@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'finance',
            'status' => 'active',
            'full_name' => 'Pras Teguh',
            'phone' => '+62812345679',
        ]);

        \App\Models\User::create([
            'name' => 'Raditya Dika',
            'email' => 'radityadika@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'finance',
            'status' => 'active',
            'full_name' => 'Raditya Dika',
            'phone' => '+62812345680',
        ]);

        \App\Models\User::create([
            'name' => 'Dono Pradana',
            'email' => 'donopra@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'finance',
            'status' => 'inactive',
            'full_name' => 'Dono Pradana',
            'phone' => '+62812345681',
        ]);

        // Create Accounts (Rekening)
        $bca = \App\Models\Account::create([
            'name' => 'BCA',
            'account_type' => 'bank',
            'balance' => 141000,
            'description' => 'Bank Central Asia',
        ]);

        $dana = \App\Models\Account::create([
            'name' => 'DANA',
            'account_type' => 'cash',
            'balance' => 100000,
            'description' => 'DANA E-Wallet',
        ]);

        $bni = \App\Models\Account::create([
            'name' => 'BNI',
            'account_type' => 'bank',
            'balance' => 2000000,
            'description' => 'Bank Negara Indonesia',
        ]);

        $uangTunai = \App\Models\Account::create([
            'name' => 'Uang Tunai',
            'account_type' => 'cash',
            'balance' => 300000,
            'description' => 'Cash on Hand',
        ]);

        // Create Categories - Income
        $feeKonsultasi = \App\Models\Category::create([
            'name' => 'Fee Konsultasi',
            'sub_category' => 'Kas Kecil',
            'type' => 'income',
            'color' => '#ef4444',
        ]);

        $sewaPeralatan = \App\Models\Category::create([
            'name' => 'Sewa Peralatan',
            'sub_category' => 'Kas Besar',
            'type' => 'income',
            'color' => '#f97316',
        ]);

        $penjualanProduk = \App\Models\Category::create([
            'name' => 'Penjualan Produk',
            'sub_category' => 'Kas Besar',
            'type' => 'income',
            'color' => '#06b6d4',
        ]);

        $subscription = \App\Models\Category::create([
            'name' => 'Subscription',
            'sub_category' => null,
            'type' => 'income',
            'color' => '#8b5cf6',
        ]);

        // Create Categories - Expense
        $makanSiang = \App\Models\Category::create([
            'name' => 'Makan Siang',
            'sub_category' => 'Kas Kecil',
            'type' => 'expense',
            'color' => '#ef4444',
        ]);

        $gaji = \App\Models\Category::create([
            'name' => 'Gaji',
            'sub_category' => null,
            'type' => 'expense',
            'color' => '#f97316',
        ]);

        $alatOperasional = \App\Models\Category::create([
            'name' => 'Alat Operasional',
            'sub_category' => null,
            'type' => 'expense',
            'color' => '#06b6d4',
        ]);

        $biayaPemasaran = \App\Models\Category::create([
            'name' => 'Biaya Pemasaran',
            'sub_category' => null,
            'type' => 'expense',
            'color' => '#8b5cf6',
        ]);

        $listrik = \App\Models\Category::create([
            'name' => 'Listrik',
            'sub_category' => 'Kas Kecil',
            'type' => 'expense',
            'color' => '#10b981',
        ]);

        // Create Transactions - Income
        \App\Models\Transaction::create([
            'title' => 'Konsultasi IT',
            'amount' => 600000,
            'type' => 'income',
            'category_id' => $feeKonsultasi->id,
            'account_id' => $bca->id,
            'transaction_date' => '2024-06-03',
            'description' => 'IT Consultation Service',
            'created_by' => 2, // Pras Teguh
        ]);

        \App\Models\Transaction::create([
            'title' => 'Sewa IOT',
            'amount' => 300000,
            'type' => 'income',
            'category_id' => $sewaPeralatan->id,
            'account_id' => $dana->id,
            'transaction_date' => '2024-06-04',
            'description' => 'IOT Equipment Rental',
            'created_by' => 3, // Raditya Dika
        ]);

        \App\Models\Transaction::create([
            'title' => 'Website SIMRS',
            'amount' => 230000,
            'type' => 'income',
            'category_id' => $penjualanProduk->id,
            'account_id' => $bni->id,
            'transaction_date' => '2024-06-20',
            'description' => 'Hospital Management System',
            'created_by' => 4, // Dono Pradana
        ]);

        \App\Models\Transaction::create([
            'title' => 'Langganan Minuland',
            'amount' => 50000,
            'type' => 'income',
            'category_id' => $subscription->id,
            'account_id' => $uangTunai->id,
            'transaction_date' => '2024-06-06',
            'description' => 'Monthly Subscription',
            'created_by' => 3, // Raditya Dika
        ]);
    }
}
