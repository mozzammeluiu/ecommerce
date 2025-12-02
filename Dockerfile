FROM php:8.2-fpm

RUN apt-get update \
     && apt-get install -y --no-install-recommends \
         git curl zip unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libicu-dev \
     && docker-php-ext-configure gd --with-freetype --with-jpeg \
     && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
     && rm -rf /var/lib/apt/lists/*

# Install composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Add entrypoint
COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

COPY composer.json /var/www/html/

# Copy application
COPY . /var/www/html

# Install PHP dependencies after copying full app so autoload is correct
RUN if [ -f composer.json ]; then composer update --no-interaction --prefer-dist --no-dev --no-scripts; fi

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

 # Removed legacy packages manifest override to allow auto-discovery

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/docker-entrypoint"]
CMD ["php-fpm"]

# Copy project php.ini if present to suppress deprecated notices
COPY php.ini /usr/local/etc/php/conf.d/app.ini
