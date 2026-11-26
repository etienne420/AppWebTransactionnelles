FROM php:8.2-apache
RUN apt-get update \
    && apt-get install -y --no-install-recommends unzip git libonig-dev libsqlite3-dev libpng-dev libjpeg62-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring gd \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html

# Le code et les dépendances dans l'image (utilisés par le CI).
# En développement, le volume de compose.yaml remplace ce dossier.
COPY . .
RUN composer install --no-interaction --prefer-dist --no-progress \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]