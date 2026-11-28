# Municipality Management System

Municipality Management System aims to streamline administrative, operational, and citizen-related processes within Lebanese municipalities. The system provides a centralized platform for citizen services, financial management, urban planning, permits, HR, events, and reporting.

## Documentation

- **Product Requirements Document:** `docs/PRD.md`
- **Technical Design Document:** `docs/TDD.md`

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (or Docker Engine + Docker Compose on Linux)
- Node.js & npm (for Vite / Tailwind CSS)
- Git

## Local Setup (Docker)

Run these steps after cloning or pulling the repository:

1. **Clone the repository**
   ```bash
   git clone https://github.com/Jawad-koeik/Municipality-Management-System.git
   cd Municipality-Management-System
   ```

2. **Create your `.env` file**
   ```bash
   cp .env.example .env
   ```
   *(In Windows CMD, use `copy .env.example .env`. PowerShell, Git Bash, macOS, and Linux all support `cp`.)*

3. **Build and start the Docker containers** (waits automatically until MySQL is healthy)
   ```bash
   docker-compose up -d --build
   ```

4. **Install PHP dependencies & generate app key**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   ```

5. **Run database migrations and seeders**
   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

6. **Install & build frontend assets (Vite + Tailwind CSS)**
   ```bash
   npm install
   npm run build
   ```
   *(Or run `npm run dev` while actively editing Blade/CSS files.)*

7. **Set storage permissions *(required on Linux / WSL, optional on Windows)***
   ```bash
   docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
   ```

8. **Run automated tests**
   ```bash
   docker-compose exec app php artisan test
   ```

Then open **http://localhost:8080** in your browser.

---

## Seeded Test Accounts

All seeded accounts use the password **`password`**:

| Role | Email | Notes |
| --- | --- | --- |
| Admin / Mayor | `admin@mms.test` | Full access |
| Finance Officer | `finance@mms.test` | Finance & billing |
| Urban Planner | `planner@mms.test` | Projects & tasks |
| HR Manager | `hr@mms.test` | Employees & attendance |
| Clerk / Staff | `clerk@mms.test` | Citizen requests & permits |
| Citizen / Resident | `citizen@mms.test` | Citizen portal (also `citizen2@mms.test`) |

---

## Current Foundation Status & Team Workflow

**Already implemented on `main`:**
- Full 13-table MySQL schema, Eloquent models/relationships, and seeders (`roles`, `departments`, `users`, `citizens`, `requests`, `permits`, `payments`, `projects`, `tasks`, `employees`, `attendance`, `events`, `documents`).
- Authentication (`/login`, `/register`, `/logout`), `RoleMiddleware` (`role:...`), and role-aware `/dashboard`.
- Bilingual English (LTR) / Arabic (RTL) switcher (`/locale/{en|ar}` + `lang/ar.json`).

**How teammates should work:**
1. Pull the latest `main` before starting: `git pull origin main`
2. Create a feature branch for your assigned module: `git checkout -b feature/<module-name>`
3. Use `__('...')` for all UI text and Tailwind logical classes (`ms-`, `me-`, `ps-`, `pe-`, `text-start`) so English/Arabic RTL both work.
4. Run `docker-compose exec app php artisan test` before opening a Pull Request into `main`.

---

### Database Connection (GUI clients like TablePlus / DBeaver)

- **Host:** `127.0.0.1`
- **Port:** `3307`
- **Database:** `Municipality-Management-System`
- **Username:** `mms_user`
- **Password:** `secret`
