# Modern QR Code Generator

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg)
![License](https://img.shields.io/badge/License-MIT-blue.svg)

Aplikasi generator QR Code modern dengan tampilan yang menarik dan mudah digunakan. Dibuat menggunakan Laravel dan Bootstrap.

## 📋 Fitur Utama

-   ✨ Interface modern dan responsif
-   🎨 Generate QR Code dari teks atau URL
-   📏 Pilihan ukuran QR Code (100x100 - 400x400 px)
-   💾 Download QR Code dalam format PNG
-   🌈 Tampilan dengan efek visual menarik
-   📱 Mendukung semua perangkat (Responsive)

## 🚀 Teknologi

-   **Laravel** v10.x - Framework PHP
-   **Bootstrap** v5.3 - Framework CSS
-   **Simple QR Code** - Package QR Code generator
-   **Bootstrap Icons** - Icon pack

## ⚙️ Instalasi

### Prasyarat

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   Git

### Langkah Instalasi

1. Clone repository

```bash
git clone https://github.com/alfreinsco/qrcode-generator.git
cd qrcode-generator
```

2. Install dependencies PHP

```bash
composer install
```

3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Install package QR Code

```bash
composer require simplesoftwareio/simple-qrcode
```

5. Setup storage

```bash
php artisan storage:link
mkdir -p storage/app/public/qrcodes
chmod -R 775 storage
```

6. Konfigurasi .env

```env
FILESYSTEM_DISK=public
```

7. Jalankan server

```bash
php artisan serve
```

## 💻 Penggunaan

1. Buka aplikasi di browser: `http://localhost:8000`
2. Masukkan teks atau URL yang ingin di-generate menjadi QR Code
3. Pilih ukuran QR Code yang diinginkan
4. Klik tombol "Generate QR Code"
5. QR Code akan muncul dan bisa diunduh

## 🔧 Kustomisasi

Anda dapat mengkustomisasi tampilan dengan mengubah:

-   Warna dan style di `resources/views/qrcode-generator.blade.php`
-   Ukuran QR Code di form select
-   Konfigurasi QR Code di `QRCodeController.php`

## 🤝 Kontribusi

Kontribusi selalu diterima dengan senang hati:

1. Fork repository
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📝 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Author

Dibuat oleh [Marthin Alfreinsco Salakory](https://github.com/alfreinsco)

## 📧 Kontak

Jika ada pertanyaan atau masukan, silakan hubungi:

-   GitHub: [@alfreinsco](https://github.com/alfreinsco)
-   Email: [alfreinsco@gmail.com](mailto:alfreinsco@gmail.com)
-   Whatsapp: [+62 813-1881-2027](https://wa.me/6281318812027)

---

⭐ Jangan lupa beri star jika project ini bermanfaat!
