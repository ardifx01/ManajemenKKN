# 📚 ManajemenKKN

Sistem **Manajemen KKN (Kuliah Kerja Nyata)** berbasis web untuk memudahkan admin, mahasiswa, dan pembimbing dalam mengelola kegiatan KKN.  
Dilengkapi dengan fitur pendaftaran, monitoring, dan laporan, aplikasi ini bertujuan agar proses KKN lebih terstruktur dan efisien.

---

## ✨ Fitur Utama
- 📝 **Pendaftaran Peserta** – Mahasiswa dapat melakukan registrasi secara online.  
- 📍 **Penjadwalan & Lokasi** – Admin bisa membagi kelompok dan lokasi KKN dengan mudah.  
- 📊 **Monitoring & Laporan** – Progress kegiatan bisa dipantau oleh pembimbing dan admin.  
- 👨‍🏫 **Manajemen Pembimbing** – Setiap pembimbing dapat memantau mahasiswa bimbingannya.  
- 🔐 **Autentikasi & Role** – Multi-level akses (Admin, Dosen, Mahasiswa).

---

## 🛠️ Teknologi
> *(Sesuaikan dengan stack yang kamu pakai di project ini)*  

- **Backend**: Laravel 10 / Node.js + Express / Django  
- **Frontend**: Blade Template / React / Vue.js  
- **Database**: MySQL / PostgreSQL  
- **Deployment**: VPS / cPanel / GitHub Actions  

---

## 🚀 Cara Deploy (Local)

### 1. Clone Repo
```bash
git clone https://github.com/ardifx01/ManajemenKKN.git
cd ManajemenKKN
```

## 2. Install Dependency
Laravel
```composer install
npm install && npm run dev
```
Node.js
```
npm install
```
---

## 3. Setup Environment
Copy .env.example menjadi .env lalu isi dengan konfigurasi database:
```
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=manajemen_kkn
DB_USERNAME=root
DB_PASSWORD=secret
```
---

## 4. Migrasi Database
Laravel
```
php artisan migrate --seed
```
Node.js
```
npm run migrate && npm run seed
```
---

## 5. Jalankan Server
Laravel
```
php artisan serve
```
Node.js
```
npm start
```
Akses di: http://localhost:8000 atau http://127.0.0.1:3000
