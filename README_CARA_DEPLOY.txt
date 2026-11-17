PANDUAN DEPLOY FIX VERCEL + SUPABASE (SI KEUANGAN GEREJA ST. MARTINUS)
========================================================================
Konfigurasi Host & Username Supabase Anda SUDAH DISETEL OTOMATIS di dalam:
- vercel.json
- config/database.php
- .env

Host     : aws-1-ap-northeast-1.pooler.supabase.com
Port     : 6543
Database : postgres
Username : postgres.pphlbdwggoirhujkrbin

========================================================================
LANGKAH 1: ISI TABEL DATABASE DI SUPABASE (Tanpa Perlu Terminal!)
========================================================================
1. Buka Dashboard Supabase Anda -> klik menu "SQL Editor" di sebelah kiri.
2. Klik "New query".
3. Buka file `SUPABASE_SETUP.sql` yang ada di dalam folder ZIP ini, copy seluruh
   isinya dan paste ke dalam SQL Editor Supabase, lalu klik tombol "RUN" (Hijau).
4. Selesai! Seluruh tabel (users, categories, budgets, transactions) dan
   akun default langsung terbuat di Supabase.

========================================================================
LANGKAH 2: UPLOAD KE GITHUB & DEPLOY KE VERCEL
========================================================================
1. Upload seluruh isi folder proyek ini ke repositori GitHub Anda.
2. Buka https://vercel.com -> klik "Add New..." -> "Project" -> Import repo.
3. Di menu "Environment Variables", Anda cukup menambahkan 2 variabel saja
   (karena host & username sudah tertanam di vercel.json!):
   - APP_KEY     : base64:XG8d2mU9O1ZqU5+f9kXwQ6l1oV3YxP8zK7jN4eM0sT2=
   - DB_PASSWORD : (Masukkan password database Supabase Anda)
4. Klik tombol "Deploy" dan tunggu 1-2 menit. Aplikasi siap dibuka di HP!

========================================================================
AKUN LOGIN DEFAULT:
- Admin     : admin / password123
- Bendahara : bendahara / password123
- Ketua     : ketua / password123
========================================================================
