# E-Commerce Platform

Full-stack e-commerce application built with **Laravel 13** and **PHP 8.5** for the Bangla Puzzle technical assessment.

---

## Quick Start

### Option A: Local Setup

```bash
# 1. Install dependencies
composer install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Setup database in .env and run migrations with seeders
php artisan migrate --seed

# 4. Link storage
php artisan storage:link

# 5. Start local server
php artisan serve
```

- **Storefront:** [http://localhost:8000](http://localhost:8000)
- **Admin Portal:** [http://localhost:8000/admin](http://localhost:8000/admin)

---

### Option B: Docker Setup

```bash
# 1. Setup local environment & docker override
cp .env.example .env
cp docker-compose.override.yml.example docker-compose.override.yml

# In .env, set APP_URL and DB credentials:
APP_URL=http://localhost:8080
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=secret

# 2. Build and run
docker compose up -d --build
```

*(Containers automatically run migrations, seeders, and storage link on boot).*

- **Storefront:** [http://localhost:8080](http://localhost:8080)
- **Admin Portal:** [http://localhost:8080/admin](http://localhost:8080/admin)

To stop:
```bash
docker compose down
```

---

### Database Export
A pre-seeded database SQL dump is included in the project root as `database_export.sql` (and at `database/database_export.sql`). When running with Docker, this file is automatically imported into MySQL on first boot via `/docker-entrypoint-initdb.d/`.

---

## Admin Credentials

| Role | Email | Password |
|---|---|---|
| Admin | `admin@banglapuzzle.com` | `password` |

---

## Key Routes

### Storefront
- Home: `/`
- Category Catalog: `/category/{category:slug}`
- Subcategory Catalog: `/category/{category:slug}/{subcategory:slug}`
- Product Details: `/products/{product:slug}`

### Admin Portal
- Products: `/admin/products`
- Categories: `/admin/categories`
- Subcategories: `/admin/subcategories`

---

## Architecture & Features

### 1. Service Layer
- Controllers remain lightweight. Business logic, query caching, and image handling are placed inside dedicated service classes (`ProductService`, `CategoryService`, `StorefrontService`).

### 2. Form Requests
- Request validation is handled in separate FormRequest classes (`StoreProductRequest`, `UpdateProductRequest`, etc.).

### 3. SEO-Friendly Slugs
- **Route Model Binding:** Public routes bind models via slug (`getRouteKeyName() = 'slug'`) for clean, readable URLs like `/products/wireless-headphones` or `/category/electronics/laptops`.
- **Collision Handling:** Duplicate titles automatically receive incremented suffixes (`item-1`, `item-2`) to avoid database unique constraint crashes.
- **Slug Preservation on Edit:** Updating a product or category title preserves the existing slug by default. This prevents broken links (`404`) for indexed search engines, external backlinks, and user bookmarks. If an admin explicitly edits the slug, uniqueness is re-validated while ignoring the current model ID.

### 4. Dependent Dropdowns & UI
- Category to subcategory dropdown filtering uses native Vanilla JS `fetch()`.
- Responsive Blade components for storefront and admin layouts.

### 5. Dynamic Hero Banner & Deals
- The homepage banner and top deal cards dynamically fetch discounted products directly from the database without requiring extra tables.

### 6. Safe Deletions
- Categories and subcategories that have linked products cannot be deleted to prevent orphaned data.

### 7. Multi-Image Gallery
- Products support multiple gallery images along with the main thumbnail.
- Product details page includes a JavaScript image switcher for thumbnails.

---

## Custom Packages Used

Two open-source packages I built (`thekaziomar/*`) are integrated into this project:

### 1. [`thekaziomar/laravel-smart-upload`](https://kaziomarsh24.github.io/laravel-smart-upload/)
- Automatically converts uploads to WebP format.
- Generates responsive thumbnail variants on upload.
- **Auto Storage Purge:** Models use the `HasUploadPurge` trait and declare `$purgeableFiles = ['image', 'gallery_images']` so old or replaced files are automatically deleted from storage whenever records are updated or force-deleted.
- Documentation: [laravel-smart-upload docs](https://kaziomarsh24.github.io/laravel-smart-upload/)

### 2. [`thekaziomar/laravel-atomic-cache`](https://kaziomarsh24.github.io/laravel-atomic-cache/)
- Enables tag-based caching on standard database cache drivers (MySQL).
- **Auto Cache Busting:** Models use the `AutoClearsCache` trait to invalidate their virtual tag versions on `saved` and `deleted` events.
- **Parent Cache Invalidation:** Models define `$cacheParents = ['category', 'subcategory']` so modifying a product automatically clears its parent category catalog cache.
- **Cache Architecture Audit:** Run `php artisan atomic-cache:check` to inspect model cache health and verify parent invalidation links.
- Documentation: [AtomicCache Service Layer Guide](https://kaziomarsh24.github.io/laravel-atomic-cache/guide/layer-4-services)

---

## Production & SSL Deployment

The project is pre-configured for direct VPS deployment with automated Docker orchestration, Nginx reverse proxy, and Let's Encrypt SSL.

### 1. Configure Domain & Environment
On your production server, set your domain in `.env` and `docker/nginx/production.conf`:
- `.env`:
  ```env
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=https://yourdomain.com
  ```
- `docker/nginx/production.conf`:
  Replace `server_name _;` with your domain (e.g. `server_name yourdomain.com www.yourdomain.com;`).

### 2. Start Services
```bash
docker compose up -d --build
```
*(The container entrypoint automatically waits for MySQL, imports/migrates the database, links storage, and caches configurations).*

### 3. Issue Free SSL Certificate (One-Time Command)
Once your domain DNS points to the server IP, run:
```bash
docker compose run --rm certbot certonly \
  --webroot \
  --webroot-path=/var/www/certbot \
  -d yourdomain.com \
  -d www.yourdomain.com \
  --email your-email@example.com \
  --agree-tos \
  --no-eff-email

# Reload Nginx to activate SSL
docker compose exec nginx nginx -s reload
```

*(The included `certbot` container automatically handles certificate renewals every 12 hours).*
