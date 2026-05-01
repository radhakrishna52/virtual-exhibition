FROM php:8.3-apache

# Enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files
COPY . /var/www/html/

# Fix permissions for uploads
RUN mkdir -p /var/www/html/uploads && chmod 777 /var/www/html/uploads

# Apache config to allow .htaccess
RUN echo '<Directory /var/www/html>\n\tOptions Indexes FollowSymLinks\n\tAllowOverride All\n\tRequire all granted\n</Directory>' \
    > /etc/apache2/conf-available/app.conf && a2enconf app

EXPOSE 80
