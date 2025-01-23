# Use an official PHP image as the base
FROM php:8.1-apache

# Set the working directory to Laravel's root
WORKDIR /var/www

# Copy all files to the container (for Composer installation)
COPY . /var/www

# Install required PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        curl \
        git

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions for Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Laravel dependencies
RUN composer install --no-interaction --optimize-autoloader

# Set the web server's document root to Laravel's public directory
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/public\n\
    <Directory /var/www/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set permissions for Laravel
RUN chmod -R 755 /var/www && chown -R www-data:www-data /var/www

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
