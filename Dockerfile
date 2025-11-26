# Base image PHP
FROM php:8.2-cli

# Install dependency yang dibutuhkan Laravel
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git curl zip unzip \
        libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
        libonig-dev libxml2-dev libicu-dev zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql zip exif pcntl bcmath gd opcache intl xml sockets \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Setting workdir
WORKDIR /var/www/html

# Copy semua source code project Laravel (termasuk artisan)
COPY . . 

# Install Laravel dependency
RUN composer install --prefer-dist --no-progress --no-suggest --no-interaction --optimize-autoloader

# (Optional) Set permission untuk storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port aplikasi
EXPOSE 8000

# Command untuk run Laravel (sesuaikan production atau dev)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
