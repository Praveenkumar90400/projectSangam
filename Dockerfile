# Use an official PHP image as the base
FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www

# Copy application files to the container
COPY . /var/www

# Ensure public directory exists
RUN mkdir -p /var/www/public

# Update the package list and install dependencies
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        curl \
        git && \
    docker-php-ext-install pdo pdo_mysql && \
    apt-get clean

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Debug: List contents of public directory to verify if index.php exists
RUN ls -al /var/www/public

# Set environment variables directly
ENV DB_HOST="my-db-server" \
    DB_DATABASE="Mysql" \
    DB_USERNAME="root" \
    DB_PASSWORD="root"

# Set the permissions for storage and bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www

# Configure Apache
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/public\n\
    <Directory /var/www/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Clear Laravel configuration cache
RUN php artisan config:clear

# Set the entrypoint
CMD ["apache2-foreground"]

# Use an official PHP image as the base
FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www

# Copy application files to the container
COPY . /var/www

# Ensure public directory exists
RUN mkdir -p /var/www/public

# Update the package list and install dependencies
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        curl \
        git && \
    docker-php-ext-install pdo pdo_mysql && \
    apt-get clean

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Debug: List contents of public directory to verify if index.php exists
RUN ls -al /var/www/public

# Set environment variables directly
ENV DB_HOST="my-db-server" \
    DB_DATABASE="Mysql" \
    DB_USERNAME="root" \
    DB_PASSWORD="root"

# Set the permissions for storage and bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www

# Configure Apache
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/public\n\
    <Directory /var/www/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Clear Laravel configuration cache
RUN php artisan config:clear

# Set the entrypoint
CMD ["apache2-foreground"]

