<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Docker (development)

You can run this project inside Docker containers for local development. The repo includes a `Dockerfile` and `docker-compose.yml`.

Quick steps (PowerShell):

1. Copy the environment file and tune values if you want to override defaults that are compatible with the compose services:

```powershell
cp .env.example .env
```

2. Build and start containers (detached):

```powershell
docker compose up -d --build
```

3. Install composer deps (if they weren't installed during build) and generate app key:

```powershell
docker compose exec app composer install
docker compose exec app php artisan key:generate
```

4. Visit the app in your browser at http://localhost:8000

Useful extras
- Run migrations:

```powershell
docker compose exec app php artisan migrate
```

- Run tests:

```powershell
docker compose exec app vendor/bin/phpunit
```

Environment
- The docker compose file sets up a MySQL database at host `db` and Redis at `redis`. Default DB credentials are in `docker-compose.yml`.

Troubleshooting DB host resolution

If you see an error like `SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo for db failed: No such host is known.` it means your app is configured to connect to a host named `db` but that hostname can't be resolved on the current runtime.

Common fixes:

- If you're using the included Docker compose stack, ensure the containers are running and healthy:

```powershell
docker compose up -d --build
docker compose ps
```

- If you run the app with `php artisan serve` (outside of Docker) update `.env` and set `DB_HOST=127.0.0.1` (or the host where your MySQL server is running). Then run migrations.

- As a convenient local dev alternative you can use SQLite (requires no TCP host):

```
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
```

Create the sqlite file and run migrations:

```powershell
New-Item -Path database\database.sqlite -ItemType File
php artisan migrate --seed
```

Note: The web admin listing now falls back to a small demo set if the DB cannot be reached — so the UI shouldn't crash with a 500 while you're iterating locally.

Note: `docker.compose.yml` is also provided (same content) in case you requested that specific filename.

### Simple frontend demo

I added a small demo frontend you can open at: http://localhost:8000/frontend

This page is a tiny Vite-powered UI that fetches example JSON from /api/items and renders it in the browser.

Frontend development tips:

- Install JS deps and run Vite (in a separate terminal) for hot reload:

```powershell
npm install
npm run dev
```

- Build the frontend assets for production:

```powershell
npm run build
```

If you run the app inside the `app` container, you can execute the Vite commands there if Node is installed in the container — otherwise, run them on your host machine and mount built assets into `public`.

Docker runtime troubleshooting

- If you get a 500 after starting the containers, common causes are missing PHP deps (vendor/) or missing built assets (public/build/manifest.json).
- The compose setup mounts your project into the `app` container; if your host doesn't have `vendor/` or built assets, the container can be started but the app will 500.

Quick Docker troubleshooting steps:

1. Rebuild and restart containers (rebuild the image and run the app's entrypoint which will install deps if needed):

```powershell
docker compose up -d --build
```

2. If the app still 500s, open an interactive shell and inspect logs / install deps manually:

```powershell
docker compose exec app bash
# inside container
composer install
npm install && npm run build
php artisan view:clear
php artisan cache:clear
exit
```

3. Tail container logs while you reproduce the error to see details:

```powershell
docker compose logs -f app
```

I added an idempotent `docker-entrypoint.sh` which runs composer/npm build if needed and clears compiled views — that should reduce 500 failures when the container starts with empty volumes.

Pages added by the demo

- /frontend — landing page for the Blade demo
 - / (root) — now points to the Blade frontend demo (same as `/frontend`)
 - /frontend — landing page for the Blade demo
- /frontend/items — items list (click "Load items" to fetch /api/items)
- /frontend/items/{id} — item detail (fetches /api/items/{id})

All API endpoints are available under `/api`:

- GET /api/items — list items
- GET /api/items/{id} — single item

Appearance and default route

- The frontend UI has been refreshed with a modern-looking header, hero area, and cards using Tailwind utilities.
- The app root `/` now serves the frontend demo so opening the base URL loads the Blade frontend directly.
