# Website Jurnal (Open Journal Systems)

Platform publikasi jurnal ilmiah berbasis **Open Journal Systems 3.6** dengan tema kustom **UI/UX Pro Max** (glassmorphism, tipografi Inter & Outfit).

> **Project Owner:** Muhammad Anhar Solihin

---

## Persyaratan

| Komponen | Versi |
|----------|--------|
| PHP | 8.2+ |
| MySQL / MariaDB | 5.7+ / 10.x |
| Apache | 2.4 (XAMPP) |
| OJS | 3.6.0 |

---

## Instalasi cepat (XAMPP)

### 1. Clone & submodule

```bash
git clone https://github.com/anhar-glicth/website-jurnal.git
cd website-jurnal
git submodule update --init --recursive
```

### 2. Database

1. Start **Apache** dan **MySQL** di XAMPP Control Panel.
2. Buat database `oai_jurnal` di phpMyAdmin.
3. Import backup SQL jika ada, atau jalankan wizard instalasi OJS.

### 3. Konfigurasi

```bash
copy config.TEMPLATE.inc.php config.inc.php
```

Sesuaikan `[database]` di `config.inc.php` (default XAMPP: user `root`, password kosong).

### 4. Pengaturan jurnal (opsional, sudah disertakan skrip)

```bash
c:\xampp\mysql\bin\mysql.exe -u root oai_jurnal < dbscripts\setup\journal_paradaya_settings.sql
```

Skrip ini mengaktifkan tema **uiProMax**, melengkapi metadata **Jurnal Paradaya**, dan placeholder plugin Crossref/Analytics.

### 5. Jalankan

Buka: **http://localhost/ojs**

Login admin: gunakan akun yang dibuat saat instalasi.

---

## Akun Default untuk Setiap Peran (Roles)

Berikut adalah daftar akun default yang dapat digunakan untuk menguji fungsionalitas OJS sesuai masing-masing peran (roles). Semua akun menggunakan password: **`Pradaya2026!`**

| Peran (Role) | Username | Email | Deskripsi Akses |
|---|---|---|---|
| **Site Administrator** | `im_anhars` | *ditentukan saat install* | Akses penuh seluruh instalasi sistem OJS |
| **Journal Manager** | `manager_pradaya` | `manager@pradaya.com` | Pengaturan tampilan & operasional jurnal |
| **Section Editor** | `editor_pradaya` | `editor@pradaya.com` | Pengelolaan naskah & penugasan reviewer |
| **Reviewer** | `reviewer_pradaya` | `reviewer@pradaya.com` | Penilaian kelayakan naskah (Mitra Bestari) |
| **Author** | `author_pradaya` | `author@pradaya.com` | Pengiriman naskah baru & revisi penulis |
| **Reader** | `reader_pradaya` | `reader@pradaya.com` | Pembaca umum & langganan notifikasi |

> [!WARNING]
> Demi keamanan, harap segera mengubah password akun-akun ini ketika dideploy di server produksi / hosting online.

---

## Tema UI/UX Pro Max

| Item | Lokasi |
|------|--------|
| Tema | `plugins/themes/uiProMax/` |
| CSS premium | `plugins/generic/premiumCss/styles/premium.css` |
| Aktivasi | Settings → Website → Appearance → Theme → **UI/UX Pro Max** |

Template header premium ada di tema (bukan di core PKP), sehingga upgrade OJS lebih aman.

---

## Email

Development: email dicatat ke log (`default = log`).

Production: ikuti panduan [docs/SETUP-SMTP.md](docs/SETUP-SMTP.md).

---

## Integrasi (isi kredensial di admin)

| Plugin | Menu admin |
|--------|------------|
| Crossref (DOI) | Settings → Distribution → DOI → Crossref |
| Google Analytics | Settings → Website → Plugins → Google Analytics |
| Google Scholar | Otomatis jika metadata jurnal lengkap |

---

## Keamanan

- `config.inc.php` **tidak** di-commit (ada di `.gitignore`).
- Setelah deploy: ganti `salt`, `api_key_secret`, `base_url`, dan `allowed_hosts`.
- Gunakan HTTPS di production (`force_ssl = On`).

---

## Struktur kustom

```
plugins/themes/uiProMax/     # Tema aktif
plugins/generic/premiumCss/  # Stylesheet premium
dbscripts/setup/             # SQL pengaturan jurnal
docs/SETUP-SMTP.md           # Panduan email
```

---

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Tampilan lama | Clear cache: hapus isi `cache/t_compile/` dan `cache/opcache/` |
| Tema tidak muncul | Pastikan `themePluginPath = uiProMax` di journal settings |
| Email tidak terkirim | Ubah `default` ke `smtp` — lihat SETUP-SMTP.md |

---

Developed by **Muhammad Anhar Solihin**
