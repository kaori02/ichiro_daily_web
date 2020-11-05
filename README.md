# Ichiro Daily Web

## How To Install

### 1. Clone This Repo

```sh
git clone https://github.com/kaori02/ichiro_daily_web
```

### 2. Install Composer

```sh
cd ichiro_daily_web; composer install
```

### 3. Install Node Module

```sh
npm install && npm run dev
```

### 4. Create .env file

- Create `.env` file
- Copy everything from `.env.example` to `.env`
- Change `DB_DATABASE=laravel` to `DB_DATABASE=ichiro_daily_web`
- Change `APP_NAME=Laravel` to `APP_NAME="Ichiro Daily Web"`

### 5. Create db named 'ichiro_daily_web' on your local

### 6. create key

```sh
php artisan key:generate
```

### 7. Migrate

```sh
php artisan migrate
```

### 8. Run Web On Your Local

```sh
php artisan serve
```
