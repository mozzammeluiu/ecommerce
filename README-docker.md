# Run with Docker

This project can be run with Docker using the provided `Dockerfile` and `docker-compose.yml`.

Quick start

1. Build and start containers:

```bash
docker compose up --build
```

2. Open the app in your browser at: http://localhost:8000

Notes and common tasks
- The database service is MySQL 5.7 exposed on `3306`.
- If your app requires an `.env` file, the entrypoint will copy `.env.example` to `.env` if none exists. Edit `.env` to adjust DB credentials (use host `db`).
- To run artisan commands inside the `app` container:

```bash
docker compose exec app bash
php artisan migrate --force
php artisan cache:clear
```

Troubleshooting
- If you see permission errors, run:

```bash
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
```
