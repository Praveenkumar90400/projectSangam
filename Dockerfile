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
    && docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the application files
COPY . .

# Set the correct permissions and ownership
RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html

# Set the ServerName directive
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


# Update Apache configuration to allow access and set DirectoryIndex
RUN echo "<Directory \"/var/www/html\">\n\tOptions Indexes FollowSymLinks\n\tAllowOverride None\n\tRequire all granted\n\tDirectoryIndex index.php index.html\n</Directory>" >> /etc/apache2/apache2.conf

# Define a DocumentRoot for Apache
COPY apache2.conf /etc/apache2/sites-available/default.conf
RUN a2ensite default 

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
