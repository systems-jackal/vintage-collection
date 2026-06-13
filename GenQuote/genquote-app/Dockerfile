FROM php:8.2-apache

# Install system dependencies: PostgreSQL driver, zip support, and unzip
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Enable mod_rewrite for clean URLs
RUN a2enmod rewrite

# Copy application code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/public

# Install Composer (latest)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Set document root to public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Keep Apache in foreground
CMD ["apache2-foreground"]

EXPOSE 80