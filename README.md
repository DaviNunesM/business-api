## Project Setup

```sh
cp .env.example .env
composer install
php artisan serve
```

#### Access the project at http://localhost:8001





## Project Setup with Docker

```sh
cp .env.example .env
docker compose up -d
```

#### Access the project at http://localhost:8080


# Routes
### Get Company:
* GET: /api/company/{cnpj}