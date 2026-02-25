# Finance App

Laravel (PHP) API backend + Next.js (TypeScript) frontend. Shared PostgreSQL database with Prisma on the frontend.

## Project structure

```
├── backend/     # Laravel API (Eloquent + PostgreSQL)
└── frontend/    # Next.js TypeScript (Prisma + PostgreSQL)
```

## Prerequisites

- **PHP 8.3+** with extensions: `curl`, `dom`, `xml`, `mbstring`, `pdo`, `pdo_pgsql`
- **PostgreSQL**
- **Composer** – [getcomposer.org](https://getcomposer.org)
- **Node.js 18+**

### Ubuntu/Debian

```bash
sudo apt install php8.3-curl php8.3-xml php8.3-mbstring php8.3-pgsql postgresql
```

## Database setup

1. Create the `finance` database in PostgreSQL:

```bash
sudo -u postgres psql -c "CREATE DATABASE finance;"
```

2. Adjust `DB_*` in `backend/.env` and `DATABASE_URL` in `frontend/.env` if your credentials differ.

## Quick start

### 1. Backend (Laravel)

```bash
cd backend
composer install   # or: php ../composer.phar install
cp .env.example .env
php artisan key:generate
php artisan migrate   # run migrations
php artisan serve
```

API runs at **http://localhost:8000**.

### 2. Frontend (Next.js)

```bash
cd frontend
npm install
cp .env.example .env   # and/or .env.local
npm run db:generate    # generate Prisma client
npm run db:migrate     # or db:push to sync schema
npm run dev
```

App runs at **http://localhost:3000**.

## Prisma (frontend)

- `npm run db:generate` – generate Prisma client
- `npm run db:migrate` – create and run migrations
- `npm run db:push` – push schema to DB (prototyping)
- `npm run db:studio` – open Prisma Studio

Import the client via `src/lib/prisma.ts`:

```ts
import { prisma } from "@/lib/prisma";
const users = await prisma.user.findMany();
```

## API

- `GET /api/health` – health check
- Other API routes: `backend/routes/api.php`

## Environment

| Variable | Description |
|----------|-------------|
| `NEXT_PUBLIC_API_URL` | Laravel API URL (`http://localhost:8000`) |
| `DATABASE_URL` | PostgreSQL connection string for Prisma |
| `DB_*` (Laravel) | PostgreSQL connection for Laravel |
