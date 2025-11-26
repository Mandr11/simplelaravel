FROM php:8.2-cli
# Arguments
ARG USER=www-data
ARG UID=1000
ENV APP_ENV=local \
    COMPOSER_ALLOW_SUPERUSER=1 \
    PATH=/root/.composer/vendor/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
WORKDIR /var/www/html

# Install system deps and PHP extensions required by Laravel
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    git curl zip unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libicu-dev zlib1g-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) pdo pdo_mysql zip exif pcntl bcmath gd opcache intl xml sockets \
  && pecl install redis && docker-php-ext-enable redis \
  && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create app user
RUN useradd -G www-data,root -u ${UID} -d /home/${USER} -m ${USER} || true

# Copy only composer files to leverage Docker cache
COPY composer.json composer.lock ./

RUN composer install --prefer-dist --no-progress --no-suggest --no-interaction --optimize-autoloader

# Copy rest of application
COPY . /var/www/html

# Ensure correct permissions for storage and cache
RUN mkdir -p storage framework/bootstrap/cache \
  && chown -R ${USER}:${USER} /var/www/html/storage /var/www/html/bootstrap/cache

USER ${USER}
ENV LARAVEL_SAIL=0
EXPOSE 8000

# Default CMD runs Laravel development server so you can access the app at http://localhost:8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
