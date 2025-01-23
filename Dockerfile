# Use an official PHP image as the base
FROM php:8.1-apache

# Install required PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        curl \
        git \
        openssl && \
    docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application files
COPY . .

# Install project dependencies
RUN composer install --no-interaction

# Set the correct permissions and ownership
RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Generate a self-signed SSL certificate (for testing purposes)
RUN mkdir /etc/apache2/ssl && \
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache-selfsigned.key \
    -out /etc/apache2/ssl/apache-selfsigned.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/OU=Department/CN=localhost"

# Update Apache configuration to enable HTTPS
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

    a2enmod ssl && \
    a2ensite default-ssl

# Set the ServerName directive (optional)
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose ports 80 and 443
EXPOSE 80 443

# Start Apache server
CMD ["apache2-foreground"]
