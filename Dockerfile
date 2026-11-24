FROM php:8.1-apache

# PHP extension so the app can talk to MySQL
RUN docker-php-ext-install pdo_mysql

# Copy the app into Apache's web root
COPY *.php /var/www/html/

EXPOSE 80
