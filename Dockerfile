FROM php:8.3-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable mod_rewrite and ensure only mpm_prefork is loaded
RUN a2dismod mpm_event mpm_worker || true && \
    a2enmod mpm_prefork && \
    a2enmod rewrite

# Copy app files
COPY . /var/www/html/

# Fix permissions
RUN mkdir -p /var/www/html/uploads && chmod -R 777 /var/www/html/uploads

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Entrypoint script to set PORT dynamically
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
