FROM php:apache
RUN a2enmod rewrite
run mkdir /stubs
COPY docker/conf/ /etc/apache2/sites-available/
COPY dist/ /var/www/html/
COPY docker/conf/env.conf /var/www/html/.env
