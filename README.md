# DigiFlora

**DigiFlora** adalah aplikasi web berbasis Laravel untuk manajemen koleksi tumbuhan digital (kebun raya / herbarium). Sistem ini memungkinkan pengelolaan data tanaman, pembuatan label **QR Code**, ekspor dokumen **Word**, serta halaman publik untuk pengunjung dan peneliti di lapangan.

---

## Fitur Utama

- **Halaman Publik**
  - Beranda informasi koleksi tumbuhan
  - Galeri tumbuhan (*gallery*)
  - Pemindaian QR Code (*scan*) untuk akses cepat ke detail tumbuhan
  - Halaman "Tentang Kami"
  - Halaman detail tumbuhan berdasarkan kode (`/tumbuhan/{kode_tumbuhan}`)
- **Panel Admin**
  - Autentikasi (login / logout)
  - CRUD data tumbuhan (tambah, edit, hapus, lihat)
  - Cetak label QR Code per tumbuhan
  - Ekspor data ke dokumen **Microsoft Word** (.docx)
- **QR Code**
  - Generate QR Code otomatis untuk setiap tumbuhan menggunakan `simplesoftwareio/simple-qrcode`
- **REST API**
  - Endpoint untuk mengambil seluruh data tumbuhan maupun detail berdasarkan kode
- **Ekspor Word**
  - Generate laporan/dokumen Word menggunakan `phpoffice/phpword`

---

## Teknologi

- **Laravel 13** (PHP ^8.3)
- **SQLite** sebagai database default (mudah diubah ke MySQL/PostgreSQL)
- **Simple QrCode** untuk pembuatan QR Code
- **PHPWord** untuk ekspor dokumen Word
- **Laravel Sanctum** untuk API authentication
- **Vite** + **Tailwind** untuk front-end (asset build)

---

## Struktur Singkat

| Direktori / File | Keterangan |
| --- | --- |
| `app/Models/Tumbuhan.php` | Model data tumbuhan (nama, nama latin, deskripsi, habitat, manfaat, gambar) |
| `app/Models/QrCode.php` | Model relasi QR Code tiap tumbuhan |
| `app/Http/Controllers/PublicController.php` | Kontroler halaman publik |
| `app/Http/Controllers/Admin/PlantController.php` | Kontroler manajemen & ekspor admin |
| `app/Http/Controllers/Api/PlantApiController.php` | Kontroler API tumbuhan |
| `routes/web.php` | Definisi rute web (publik & admin) |
| `database/migrations` | Skema database (users, plants, cache, jobs, dll) |

---

## Persyaratan

- PHP >= 8.3
- Composer
- Node.js & npm

---

## Instalasi

```bash
# 1. Clone repository
git clone https://github.com/y4sirt-rgb/digiflora-ta.git
cd digiflora-ta

# 2. Instal dependensi PHP
composer install

# 3. Instal dependensi JavaScript
npm install

# 4. Siapkan file environment
cp .env.example .env
php artisan key:generate

# 5. Buat database SQLite (default)
touch database/database.sqlite

# 6. Jalankan migrasi
php artisan migrate --force

# 7. Build asset front-end
npm run build
```

## Menjalankan Aplikasi

```bash
# Mode pengembangan (server + queue + vite)
composer run dev

# Atau hanya server Laravel
php artisan serve
```

Buka <http://localhost:8000> di browser.

---

## Konfigurasi Environment

Salin `.env.example` ke `.env` dan sesuaikan nilai berikut bila diperlukan:

| Variabel | Keterangan |
| --- | --- |
| `APP_NAME` | Nama aplikasi |
| `APP_URL` | URL aplikasi |
| `DB_CONNECTION` | Koneksi database (default: `sqlite`) |
| `DB_DATABASE` | Path/ nama database |

> **Penting:** Jangan commit file `.env` yang berisi rahasia ke repository. File ini sudah termasuk dalam `.gitignore`.

---

## Menggunakan Aplikasi

1. **Akses Publik** – Kunjungi beranda, galeri, atau pindai QR Code untuk melihat detail tumbuhan.
2. **Login Admin** – Akses `/login`, lalu kelola data tumbuhan melalui `/admin/plants`.
3. **Cetak Label** – Pada detail tumbuhan admin, cetak label QR Code.
4. **Ekspor Word** – Gunakan fitur ekspor untuk mengunduh dokumen Word berisi data tumbuhan.

---

## API

| Metode | Endpoint | Keterangan |
| --- | --- | --- |
| `GET` | `/api/plants` | Mengambil seluruh data tumbuhan |
| `GET` | `/api/plants/{kode_tumbuhan}` | Mengambil detail tumbuhan berdasarkan kode |

Respon berformat JSON dengan struktur `status`, `message`, dan `data`.

---

## Testing

```bash
composer run test
```

---

## Lisensi

Proyek ini menggunakan lisensi **MIT**.
