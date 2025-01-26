# Use an official PHP image as the base
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Update package list and install required tools
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    && docker-php-ext-install \
    bcmath \
    curl \
    mbstring \
    xml \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Clone the application code from the Git repository
RUN git clone https://github.com/Praveenkumar90400/projectSangam.git /var/www/html

# Set permissions for Laravel storage and cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set environment variables directly (consider using secrets in production)
ENV DB_HOST="my-db-server" \
    DB_DATABASE="Mysql" \
    DB_USERNAME="root" \
    DB_PASSWORD="root"

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Configure Apache for Laravel
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Clear Laravel configuration cache
RUN php artisan config:clear

# Start Apache server
CMD ["apache2-foreground"]
