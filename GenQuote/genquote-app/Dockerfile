FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/a \    AllowOverride All' /etc/apache2/apache2.conf

COPY . /var/www/html/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# Install Composer dependencies (other than Google OAuth, if any)
RUN composer install --no-dev --optimize-autoloader || true

# Manually install league/oauth2-google
RUN mkdir -p vendor/league && \
    cd vendor/league && \
    git clone https://github.com/thephpleague/oauth2-google.git && \
    cd oauth2-google && \
    composer install --no-dev && \
    cd /var/www/html && \
    composer dump-autoload

RUN chown -R www-data:www-data /var/www/html/public

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]
EXPOSE 80