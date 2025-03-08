FROM php:8.4-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN apt update && apt install libicu-dev -y
RUN docker-php-ext-install intl
RUN docker-php-ext-enable intl
RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
