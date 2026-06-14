FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite

RUN sed -i '/<Directory \/var\/www\/>/a \    AllowOverride All' /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/public

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# Show composer.json content (debug)
RUN echo "=== composer.json ===" && cat composer.json

# Install dependencies using the lock file; if it fails, force update
RUN composer install --no-dev --optimize-autoloader || (echo "Install failed, trying update" && composer update --no-dev --optimize-autoloader)

# Verify that the required package is installed
RUN composer show league/oauth2-google || (echo "Package still missing, forcing require" && composer require league/oauth2-google)

RUN composer dump-autoload --optimize

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]

EXPOSE 80