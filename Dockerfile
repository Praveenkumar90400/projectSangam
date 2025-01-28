# Use an official PHP image as the base
FROM php:8.1-apache

# Install necessary packages
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install project dependencies within the container
RUN composer install

# Copy the entire project, excluding unnecessary files
COPY . . \
    --from=source \
    --exclude=node_modules

# Set document root for Apache
WORKDIR /var/www/html

# Set the correct permissions and ownership
RUN chmod -R 755 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache

# Update Apache configuration to enable proper access
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
