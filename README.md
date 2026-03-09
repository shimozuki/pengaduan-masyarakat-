# Laporin

Web aplikasi laporan pengaduan publik.

- Public: landing page + form laporan + halaman **Laporan Saya**
- Admin: dashboard **(Flux UI starter kit layout)** untuk kelola laporan + export PDF

## Tech Stack

- Laravel 12
- Livewire (Volt + Flux untuk admin)
- MySQL
- TailwindCSS (public UI)
- Dompdf (PDF export)

## Fitur Utama

- Auth (Fortify)
- Role sederhana pada `users.role`: `admin` | `user`
- User submit laporan + upload foto (maks 5 foto, 5MB per file)
- Admin filter/search laporan, update status, export PDF

## Setup (Windows / XAMPP)

### 1) Install dependencies

```bash
composer install
npm install
```

### 2) Konfigurasi environment

Copy `.env.example` ke `.env`, lalu atur DB MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laporin
DB_USERNAME=root
DB_PASSWORD=
```

### 3) Generate key + migrate + seed

```bash
php artisan key:generate
php artisan migrate --seed
```

### 4) Storage symlink (untuk akses lampiran)

```bash
php artisan storage:link
```

### 5) Build assets

```bash
npm run build
```

### 6) Run

```bash
php artisan serve
```

## Akun Admin (Seeder)

- Email: `admin@laporin.test`
- Password: `Password123!`

## Routes

- `GET /` landing page (Livewire)
- `GET /my-reports` (auth) daftar laporan user
- `POST /report` (auth, throttled) submit laporan (fallback HTTP endpoint)

Admin:

- `GET /admin` dashboard
- `GET /admin/reports` list + filter
- `GET /admin/reports/{report}` detail + update status
- `POST /admin/reports/{report}/export` download PDF

## Catatan

- Public pages menggunakan layout `resources/views/components/layouts/public.blade.php` dan CSS entrypoint `resources/css/public.css`.
- Admin dashboard menggunakan Flux UI layout starter-kit (`resources/views/components/layouts/app.blade.php`) dan CSS `resources/css/app.css`.
- Upload disimpan di `storage/app/public/reports` dengan nama file hash (Laravel default).
- Rate limit submit laporan:
  - HTTP route: `throttle:report-submit` (3/minute)
  - Livewire submit juga diberi limiter internal (3/minute per IP+user)

## Testing

```bash
php artisan test
```

Terdapat test untuk:

- Redirect dashboard berbasis role
- Laporan (submit + attachment)
- Admin export PDF (akan di-skip jika Dompdf belum ter-install)
