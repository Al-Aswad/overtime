<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Overtime Calculation

Simple Rest API for calculating overtime

## Installation

### Prerequisites

-   PHP 7.4
-   Composer
-   MySQL/MariaDB
-   Git

1. Clone the repository
2. Open the project directory
3. Run `composer install`

```bash
composer install
```

4. Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

5. Replace the database credentials in `.env` file

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=overtime_db
DB_USERNAME=root
DB_PASSWORD=root
```

5. Run `php artisan test` to run the tests

```bash
php artisan test
```

6. Run `php artisan migrate:f --seed` to run the migrations and seed the database

```bash
php artisan migrate:f --seed
```

7. Run `php artisan serve` to start the server

```bash
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
