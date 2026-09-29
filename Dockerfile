FROM php:8.2-cli

COPY . /var/www/html/

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /var/www/html"]
