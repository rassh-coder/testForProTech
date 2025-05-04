# Dockerfile
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Установка зависимостей
RUN apk add --no-cache \
    postgresql-dev \
    nginx \
    supervisor \
    libzip-dev \
    zip \
    unzip \
    curl \
    nodejs \
    npm

# Установка PHP расширений
RUN docker-php-ext-install pdo pdo_pgsql zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование конфигов
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Копирование исходного кода
COPY . .

# Установка зависимостей
RUN composer install --optimize-autoloader --no-dev \
    && npm install \
    && npm run build \
    && chmod -R 777 storage bootstrap/cache

EXPOSE 9000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
