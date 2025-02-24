# WoClass README

This is a Laravel app for scheduling classes and events.


## Requirements

- PHP `8.3` or higher
- Composer `v.2`
- Node.js `v.18` or higher

## Installation

- Clone the repository and run
```shell
composer install
```
- Install node dependencies
```shell
yarn install
```

- Create environment file `.env`
```shell
cp .env.example .env
```

- Create application key
```shell
php artisan key:generate
```

- Run migrations
```shell
php artisan migrate
```

- Seed database
```shell
php artisan db:seed
```

- Run development server
```shell
php artisan serve
```
