FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/a \    AllowOverride All' /etc/apache2/apache2.conf

COPY . /var/www/html/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/public

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]
EXPOSE 80