FROM php:8.2-apache

COPY . /var/www/html/

RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' /etc/apache2/sites-available/000-default.conf

EXPOSE 10000

CMD ["apache2-foreground"]
