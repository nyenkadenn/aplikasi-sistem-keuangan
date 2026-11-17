<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(['username' => 'admin'], [
            'name' => 'Pastor / Admin Stasi',
            'email' => 'admin@stmartinus.org',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $bendahara = User::firstOrCreate(['username' => 'bendahara'], [
            'name' => 'Bendahara Stasi Selorejo',
            'email' => 'bendahara@stmartinus.org',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
        ]);

        $ketua = User::firstOrCreate(['username' => 'ketua'], [
            'name' => 'Ketua Dewan Stasi Selorejo',
            'email' => 'ketua@stmartinus.org',
            'password' => Hash::make('password123'),
            'role' => 'ketua_stasi',
        ]);

        $c1 = Category::firstOrCreate(['name' => 'Kolekte I (Mingguan)'], ['type' => 'pemasukan', 'description' => 'Persembahan kantong kolekte misa utama']);
        $c2 = Category::firstOrCreate(['name' => 'Kolekte II (Pembangunan)'], ['type' => 'pemasukan', 'description' => 'Dana khusus pemeliharaan fisik gereja']);
        $c3 = Category::firstOrCreate(['name' => 'Donasi / Iuran Umat'], ['type' => 'pemasukan', 'description' => 'Partisipasi bulanan umat lingkungan']);
        $c4 = Category::firstOrCreate(['name' => 'Intensi Misa & Syukur'], ['type' => 'pemasukan', 'description' => 'Persembahan ujud doa misa']);

        $c5 = Category::firstOrCreate(['name' => 'Operasional Liturgi & Sakramen'], ['type' => 'pengeluaran', 'description' => 'Lilin, hosti, anggur misa, bunga altar']);
        $c6 = Category::firstOrCreate(['name' => 'Listrik, Air & Internet'], ['type' => 'pengeluaran', 'description' => 'Tagihan utilitas bulanan stasi']);
        $c7 = Category::firstOrCreate(['name' => 'Pemeliharaan & Kebersihan'], ['type' => 'pengeluaran', 'description' => 'Alat kebersihan, perbaikan sound system']);
        $c8 = Category::firstOrCreate(['name' => 'Sosial Karitatif Umat'], ['type' => 'pengeluaran', 'description' => 'Bantuan umat prasejahtera dan duka cita']);

        Budget::firstOrCreate(['category_id' => $c5->id, 'year' => 2026], ['allocated_amount' => 12000000, 'notes' => 'Anggaran perlengkapan ibadah']);
        Budget::firstOrCreate(['category_id' => $c6->id, 'year' => 2026], ['allocated_amount' => 7500000, 'notes' => 'Anggaran utilitas']);
        Budget::firstOrCreate(['category_id' => $c7->id, 'year' => 2026], ['allocated_amount' => 10000000, 'notes' => 'Pemeliharaan fisik']);

        if (Transaction::count() === 0) {
            Transaction::create([
                'user_id' => $bendahara->id,
                'category_id' => $c1->id,
                'type' => 'pemasukan',
                'amount' => 3500000,
                'transaction_date' => now()->subDays(5)->toDateString(),
                'description' => 'Kolekte Misa Hari Minggu ke-1',
            ]);

            Transaction::create([
                'user_id' => $bendahara->id,
                'category_id' => $c2->id,
                'type' => 'pemasukan',
                'amount' => 2100000,
                'transaction_date' => now()->subDays(5)->toDateString(),
                'description' => 'Kolekte Renovasi Gedung Stasi',
            ]);

            Transaction::create([
                'user_id' => $bendahara->id,
                'category_id' => $c3->id,
                'type' => 'pemasukan',
                'amount' => 1250000,
                'transaction_date' => now()->subDays(3)->toDateString(),
                'description' => 'Iuran Swadaya Umat Lingkungan St. Petrus',
            ]);

            Transaction::create([
                'user_id' => $bendahara->id,
                'category_id' => $c5->id,
                'type' => 'pengeluaran',
                'amount' => 450000,
                'transaction_date' => now()->subDays(4)->toDateString(),
                'description' => 'Beli Lilin Misa & Minyak Altar',
            ]);

            Transaction::create([
                'user_id' => $bendahara->id,
                'category_id' => $c6->id,
                'type' => 'pengeluaran',
                'amount' => 620000,
                'transaction_date' => now()->subDays(2)->toDateString(),
                'description' => 'Bayar Tagihan Listrik PLN Stasi',
            ]);
        }
    }
}
