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

# Install PHP dependencies (dompdf, league/oauth2-google)
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Set document root to public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80