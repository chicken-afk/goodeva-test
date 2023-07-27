## Langkah-langkah Instalasi

### Prasyarat
Sebelum memulai, pastikan Anda telah memenuhi persyaratan berikut:

* PHP versi 7.4 atau lebih baru telah terinstal di sistem Anda.
* Composer telah terpasang di sistem Anda.
* MySQL telah terpasang dan berjalan di sistem Anda.

### Langkah 1: Clone Repositori
Buka terminal atau command prompt, lalu jalankan perintah berikut untuk meng-clone repositori proyek Laravel API pada branch main repository ini

### Langkah 2: Instal Dependensi

Pindah ke direktori proyek yang telah Anda kloning dengan perintah berikut:
<pre>
> cd nama-folder-proyek
</pre>

Selanjutnya, jalankan perintah berikut untuk menginstal semua dependensi proyek melalui Composer:
<pre>
> composer install
</pre>

### Langkah 3: Konfigurasi Database

Buatlah salinan file .env.example menjadi .env:
<pre>
> cp .env.example .env
</pre>

Kemudian, buka file .env menggunakan teks editor favorit Anda dan konfigurasi pengaturan database:

<pre>
DB_CONNECTION=mysql
DB_HOST=nama_host_database
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
</pre>

Pastikan untuk mengganti nama_host_database, nama_database, username_database, dan password_database sesuai dengan informasi koneksi database Anda.



### Langkah 4: Generate Key Aplikasi
Jalankan perintah berikut untuk menghasilkan kunci aplikasi yang diperlukan:
<pre>
php artisan key:generate
</pre>

### Langkah 5: Migrasi Database
Selanjutnya, jalankan migrasi untuk membuat tabel-tabel yang diperlukan di database:
<pre>
php artisan migrate
</pre>
Kemudian Import file pos_sistem.sql yang terdapat pada repo ini ke database yang telah dibuat


### Langkah 6: Storage
Selanjutnya, Jalankan perintah berikut untuk membuat storage:
<pre>
php artisan storage:link
</pre>

### Langkah 7: Jalankan Aplikasi
Sekarang, aplikasi Laravel Anda telah siap untuk dijalankan. Jalankan perintah berikut untuk memulai server lokal:
<pre>
php artisan serve
</pre>
Anda sekarang dapat mengakses proyek Laravel API Artikel Anda melalui http://localhost:8000 di postman.

## Account Login
Account Login Dashboard
<pre>
email : superadmin@warungacehbangari.com
password : 123456
</pre>