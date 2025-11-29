# Sistem Manajemen Keuangan

Sistem pencatatan, pengelolaan, dan pelaporan keuangan berbasis web yang dibangun dengan Laravel. Aplikasi ini membantu bisnis melacak arus kas, mengelola rekening, mengkategorikan transaksi, dan menghasilkan laporan keuangan.

## Fitur Utama

### Fungsionalitas Inti

**Dashboard**
- Ringkasan keuangan real-time dengan kartu statistik
- Grafik donat interaktif untuk breakdown pemasukan dan pengeluaran
- Analisis per kategori dengan persentase
- Pelacakan total saldo di semua rekening

**Manajemen Pengguna**
- Kontrol akses berbasis role (Admin dan Finance)
- Manajemen status pengguna (Aktif/Tidak Aktif)
- Pengelolaan profil pengguna lengkap

**Manajemen Rekening**
- Dukungan multi rekening (Rekening Bank dan Tunai)
- Kalkulasi saldo otomatis
- Update saldo real-time setiap transaksi

**Manajemen Kategori**
- Kategori pemasukan dan pengeluaran yang dapat disesuaikan
- Dukungan sub-kategori untuk klasifikasi detail
- Kategori dengan kode warna untuk organisasi visual
- Filter berdasarkan tipe (Pemasukan/Pengeluaran)

**Manajemen Transaksi**
- Tampilan terpisah untuk transaksi pemasukan dan pengeluaran
- Filter kategori dinamis berdasarkan tipe transaksi
- Update saldo rekening otomatis
- Filter rentang tanggal
- Riwayat transaksi detail dengan audit trail lengkap

**Hutang dan Piutang**
- Pelacakan hutang dan piutang terpisah
- Manajemen tanggal jatuh tempo
- Pelacakan status (Pending, Lunas, Terlambat)
- Kalkulasi total untuk jumlah outstanding

### Fitur Teknis

- Rekonsiliasi saldo otomatis
- Validasi server-side di semua form
- Desain responsif untuk mobile dan desktop
- UI modern dan bersih dengan tema gradient
- Paginasi di semua tampilan list
- Fungsi pencarian di semua modul

## Stack Teknologi

- **Framework**: Laravel 11
- **Frontend**: Blade Templates dengan Alpine.js
- **Database**: MySQL
- **Charts**: Chart.js
- **Styling**: Custom CSS
- **Authentication**: Laravel Breeze

## Instalasi

### Prasyarat

- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi
- Node.js dan NPM

### Langkah Instalasi

1. Clone repository
```bash
git clone https://github.com/jayzajie/finance-sistem.git
cd finance-sistem
```

2. Install dependensi PHP
```bash
composer install
```

3. Install dependensi JavaScript
```bash
npm install
```

4. Buat file environment
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Konfigurasi database di file `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance_db
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database
```bash
php artisan migrate
```

8. Seed database dengan data contoh (opsional)
```bash
php artisan db:seed
```

9. Jalankan development server
```bash
php artisan serve
```

10. Akses aplikasi di `http://localhost:8000`

## Kredensial Default

Setelah seeding database, Anda dapat login dengan:

- **Email**: admin@finance.com
- **Password**: password

## Skema Database

Aplikasi menggunakan tabel utama berikut:

- `users` - Akun pengguna dengan role dan status
- `accounts` - Rekening bank dan kas tunai
- `categories` - Kategori transaksi (pemasukan/pengeluaran)
- `transactions` - Semua transaksi keuangan
- `invoices` - Manajemen invoice
- `debts` - Pelacakan hutang dan piutang

## Cara Penggunaan

### Mengelola Transaksi

1. Navigasi ke "Kas Masuk" untuk pemasukan atau "Kas Keluar" untuk pengeluaran
2. Klik "Tambah" untuk membuat transaksi baru
3. Pilih tipe transaksi, kategori, dan rekening
4. Masukkan jumlah dan tanggal
5. Sistem otomatis mengupdate saldo rekening

### Organisasi Kategori

Kategori memiliki kode warna dan dapat difilter berdasarkan tipe. Saat membuat transaksi, hanya kategori yang relevan untuk tipe transaksi tersebut yang akan ditampilkan.

### Saldo Rekening

Saldo rekening dihitung otomatis berdasarkan semua transaksi. Sistem menjaga akurasi dengan:
- Menambahkan jumlah pemasukan ke rekening yang dipilih
- Mengurangi jumlah pengeluaran dari rekening yang dipilih
- Menghitung ulang saat transaksi diedit atau dihapus

## Struktur Proyek

```
finance-sistem/
├── app/
│   ├── Http/Controllers/    # Controller aplikasi
│   └── Models/              # Model Eloquent
├── database/
│   ├── migrations/          # Migrasi database
│   └── seeders/            # Seeder database
├── resources/
│   └── views/              # Template Blade
│       ├── layouts/        # File layout
│       ├── users/          # View manajemen pengguna
│       ├── accounts/       # View manajemen rekening
│       ├── categories/     # View manajemen kategori
│       ├── transactions/   # View transaksi
│       └── debts/          # View manajemen hutang
└── routes/
    └── web.php            # Route web
```

## Kontribusi

Kontribusi sangat diterima. Silakan ikuti langkah berikut:

1. Fork repository
2. Buat branch baru untuk fitur Anda
3. Lakukan perubahan
4. Submit pull request dengan deskripsi yang jelas

## Lisensi

Proyek ini bersifat open-source dan tersedia di bawah Lisensi MIT.

## Dukungan

Untuk masalah, pertanyaan, atau saran, silakan buka issue di repository GitHub.

## Roadmap

Pengembangan yang direncanakan:

- Generasi invoice dengan export PDF
- Pelaporan lanjutan (Laba Rugi, Neraca)
- Dukungan multi-currency
- Perencanaan dan forecasting budget
- Notifikasi email untuk tanggal jatuh tempo
- API endpoint untuk integrasi aplikasi mobile
- Fungsi export (Excel, CSV)

## Penghargaan

Dibangun dengan Laravel dan teknologi web modern untuk menyediakan solusi manajemen keuangan yang robust untuk bisnis kecil hingga menengah.
