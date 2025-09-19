# Patient Management Application

This project is a **Patient Management System** built with **Laravel** framework.  
It connects to an external API from **[https://mockapi.pkuwsb.id](https://mockapi.pkuwsb.id)** and provides essential CRUD features for patient data management.

---

## 🔑 Credentials
If required, the default API credentials used are:

- **Username:** `aku@pkuwsb.id`  
- **Password:** `Admin123`

---

## ⚙️ Features
- User registration with the following conditions:
  - Email must use domain `@pkuwsb.id`
  - Unique email validation
  - Password with at least 7 characters including uppercase, lowercase, and numbers
  - Profile photo upload (optional)
- User login & logout (Laravel authentication)
- Patient CRUD operations:
  - Add new patient
  - Edit patient data
  - Delete patient
  - View patient details
- Filtering and searching patients (by gender, education, blood type, etc.)
- Pagination for patient list
- Responsive design with Bootstrap 5 + custom theme
- API integration using **Laravel HTTP Client (Guzzle under the hood)**

---

## 📂 Project Notes
- Environment variables are provided in `.env.example`.  
  Please copy to `.env` and adjust as needed:
  ```bash
  cp .env.example .env
  php artisan key:generate

🚀 Installation

Clone the repository:
```bash
git clone https://github.com/<your-username>/<your-repo>.git
cd <your-repo>


Install dependencies:
```bash
composer install
npm install && npm run build


Setup environment file:
```bash
cp .env.example .env
php artisan key:generate

Run the application:
```bash
php artisan serve  and
npm run dev
