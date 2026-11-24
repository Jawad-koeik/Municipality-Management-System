# Municipality Management System

Municipality Management System aims to streamline administrative, operational, and citizen-related processes within Lebanese municipalities. The system provides a centralized platform for citizen services, financial management, urban planning, and permits — ensuring efficiency and improved communication between the municipality and citizens.

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (or Docker Engine + Docker Compose on Linux)
- Git

## Local Setup (Docker)

Run these steps after cloning the repository:

1. **Clone the repository**
   ```bash
   git clone https://github.com/Jawad-koeik/Municipality-Management-System.git
   ```

2. **Enter the project folder**
   ```bash
   cd Municipality-Management-System
   ```

3. **Create your `.env` file**
   ```bash
   cp .env.example .env
   ```
   *(In Windows CMD, use `copy .env.example .env`. PowerShell, Git Bash, macOS, and Linux all support `cp`.)*

4. **Build and start the Docker containers** (waits automatically until MySQL is healthy)
   ```bash
   docker-compose up -d --build
   ```
   *(Tip: On newer Docker versions where `docker-compose` isn't installed, use `docker compose` with a space for steps 4–8.)*

5. **Install PHP dependencies inside the container**
   ```bash
   docker-compose exec app composer install
   ```

6. **Generate the Laravel application key**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

7. **Run database migrations**
   ```bash
   docker-compose exec app php artisan migrate
   ```

8. **Set storage permissions *(required on Linux / WSL, optional on Windows)***
   ```bash
   docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
   ```

Then open **http://localhost:8080** in your browser.

### Database Connection (GUI clients like TablePlus / DBeaver)

- **Host:** `127.0.0.1`
- **Port:** `3307`
- **Database:** `Municipality-Management-System`
- **Username:** `mms_user`
- **Password:** `secret`
