-- SKRIP SQL OTOMATIS UNTUK SUPABASE SQL EDITOR
-- Jalankan langsung di menu "SQL Editor" Supabase jika tidak ingin menjalankan `php artisan migrate` di laptop

-- 1. Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'bendahara',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel Categories
CREATE TABLE IF NOT EXISTS categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    description VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabel Budgets (RAB)
CREATE TABLE IF NOT EXISTS budgets (
    id BIGSERIAL PRIMARY KEY,
    category_id BIGINT NOT NULL REFERENCES categories(id) ON DELETE CASCADE,
    year INTEGER NOT NULL,
    allocated_amount NUMERIC(15, 2) NOT NULL,
    notes TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- 4. Tabel Transactions
CREATE TABLE IF NOT EXISTS transactions (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    category_id BIGINT NOT NULL REFERENCES categories(id) ON DELETE CASCADE,
    type VARCHAR(50) NOT NULL,
    amount NUMERIC(15, 2) NOT NULL,
    transaction_date DATE NOT NULL,
    description VARCHAR(255) NOT NULL,
    proof_file VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- 5. Insert Default Users (Password untuk semua akun: password123)
INSERT INTO users (name, username, email, password, role) VALUES
('Pastor / Admin Stasi', 'admin', 'admin@stmartinus.org', '$2y$12$K.9X0H2iG/9O6k6O0qZ/6.u6uJ5Q6U6uJ5Q6U6uJ5Q6U6uJ5Q6U6u', 'admin'),
('Bendahara Stasi Selorejo', 'bendahara', 'bendahara@stmartinus.org', '$2y$12$K.9X0H2iG/9O6k6O0qZ/6.u6uJ5Q6U6uJ5Q6U6uJ5Q6U6uJ5Q6U6u', 'bendahara'),
('Ketua Dewan Stasi Selorejo', 'ketua', 'ketua@stmartinus.org', '$2y$12$K.9X0H2iG/9O6k6O0qZ/6.u6uJ5Q6U6uJ5Q6U6uJ5Q6U6uJ5Q6U6u', 'ketua_stasi')
ON CONFLICT (username) DO NOTHING;

-- 6. Insert Default Categories
INSERT INTO categories (name, type, description) VALUES
('Kolekte I (Mingguan)', 'pemasukan', 'Persembahan kantong kolekte misa utama'),
('Kolekte II (Pembangunan)', 'pemasukan', 'Dana khusus pemeliharaan fisik gereja'),
('Donasi / Iuran Umat', 'pemasukan', 'Partisipasi bulanan umat lingkungan'),
('Intensi Misa & Syukur', 'pemasukan', 'Persembahan ujud doa misa'),
('Operasional Liturgi & Sakramen', 'pengeluaran', 'Lilin, hosti, anggur misa, bunga altar'),
('Listrik, Air & Internet', 'pengeluaran', 'Tagihan utilitas bulanan stasi'),
('Pemeliharaan & Kebersihan', 'pengeluaran', 'Alat kebersihan, perbaikan sound system'),
('Sosial Karitatif Umat', 'pengeluaran', 'Bantuan umat prasejahtera dan duka cita');
