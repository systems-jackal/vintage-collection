# Stage 1: Install Composer dependencies in a dedicated stage
FROM composer:latest AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Apache + PHP
FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite

RUN sed -i '/<Directory \/var\/www\/>/a \    AllowOverride All' /etc/apache2/apache2.conf

# Copy application code
COPY . /var/www/html/

# Copy the complete vendor folder from the Composer stage
COPY --from=composer /app/vendor /var/www/html/vendor

# Set permissions
RUN chown -R www-data:www-data /var/www/html/public

# Verify the Google package is present (for debugging)
RUN if [ ! -d /var/www/html/vendor/league/oauth2-google ]; then \
        echo "ERROR: league/oauth2-google missing, forcing install" && \
        cd /var/www/html && \
        php /usr/bin/composer require league/oauth2-google --no-dev; \
    fi

# Set document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]

EXPOSE 80