FROM php:apache
RUN a2enmod rewrite
COPY docker/conf/ /etc/apache2/sites-available/
COPY dist/ /var/www/html/