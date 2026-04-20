# 1. Gunakan image PHP dengan ekstensi yang dibutuhkan
FROM php:8.2-fpm

# 2. Install sistem dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    docker-php-ext-install pdo_mysql

# 3. Set direktori kerja
WORKDIR /var/www

# 4. Copy file project ke dalam container
COPY . /var/www

# 5. Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader

# 6. Jalankan perintah saat container nyala
CMD ["php-fpm"]
