FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite

RUN sed -i '/<Directory \/var\/www\/>/a \    AllowOverride All' /etc/apache2/apache2.conf

# Copy application code
COPY . /var/www/html/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Go to document root and install dependencies including Google OAuth
WORKDIR /var/www/html
RUN composer require league/oauth2-google --no-dev --no-interaction

# Dump autoloader
RUN composer dump-autoload --optimize

# Verify installation (debug)
RUN ls -la vendor/league/oauth2-google/src/Provider/Google.php || echo "Google provider NOT found"

# Permissions
RUN chown -R www-data:www-data /var/www/html/public

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]
EXPOSE 80