FROM php:8.2-apache

# Copie tous les fichiers PHP et CSS dans le dossier servi par Apache
COPY . /var/www/html/

# Correction des permissions pour Apache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
