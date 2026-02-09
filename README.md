# 🧠 Daily Quiz App (Backend API)

Backend server untuk aplikasi mobile **Daily Quiz**. Dibangun menggunakan **Laravel** sebagai penyedia REST API yang cepat, aman, dan scalable.

Project ini berfungsi sebagai "otak" yang mengatur data soal, skor, dan logika permainan untuk aplikasi mobile (Flutter).

## 🚀 Fitur Utama

-   **Manajemen Soal (CRUD):** Admin dapat menambah, mengedit, dan menghapus soal kuis.
-   **Daily Rotation:** Menyajikan 5 soal acak yang berbeda setiap harinya secara otomatis.
-   **RESTful API:** Menyediakan endpoint JSON yang standar untuk dikonsumsi oleh aplikasi mobile.
-   **Secure Database:** Menggunakan MySQL dengan proteksi *Mass Assignment*.

## 🛠️ Teknologi yang Digunakan

-   **Framework:** Laravel 10/11
-   **Database:** MySQL
-   **Architecture:** MVC + Service Repository Pattern
-   **API Standard:** JSON Resource

## 📦 Cara Install & Menjalankan (Localhost)

Ikuti langkah ini jika ingin menjalankan project di komputer kamu:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username-kamu/daily-quiz-backend.git](https://github.com/username-kamu/daily-quiz-backend.git)
    cd daily-quiz-backend
    ```

2.  **Install Dependencies**
    Pastikan kamu sudah menginstall Composer.
    ```bash
    composer install
    ```

3.  **Setup Environment**
    Salin file konfigurasi dan generate key rahasia.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Setup Database**
    - Buat database kosong di phpMyAdmin bernama `db_daily_quiz`.
    - Buka file `.env`, sesuaikan setting database:
    ```env
    DB_DATABASE=db_daily_quiz
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Migrasi Database**
    Membuat tabel otomatis.
    ```bash
    php artisan migrate
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Server akan berjalan di: `http://127.0.0.1:8000`

## 🔌 Dokumentasi API

Berikut adalah daftar Endpoint yang tersedia untuk aplikasi Mobile:

### 1. Ambil Soal Hari Ini
-   **URL:** `GET /api/v1/quizzes`
-   **Deskripsi:** Mengambil 5 soal acak yang aktif hari ini.
-   **Response:**
    ```json
    {
      "status": true,
      "data": [
        {
          "id": 1,
          "question": "Ibukota Indonesia?",
          "options": ["Jakarta", "Bandung", "Solo", "Medan"],
          "date": "2023-10-27"
        }
      ]
    }
    ```

### 2. Tambah Soal (Admin)
-   **URL:** `POST /api/v1/quizzes`
-   **Body (JSON):**
    ```json
    {
      "question": "Siapa penemu lampu?",
      "option_a": "Edison",
      "option_b": "Tesla",
      "option_c": "Einstein",
      "option_d": "Newton",
      "answer": "a",
      "active_date": "2023-10-28"
    }
    ```

---
Dibuat oleh **[Muhammad Rifqi Alimin]**.
