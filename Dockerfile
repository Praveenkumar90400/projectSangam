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
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Add the application
ADD . /app

# Set the working directory
WORKDIR /var/www/html

# Copy composer.json and composer.lock to the working directory
COPY composer.json composer.lock ./

# Copy the application files
COPY . .

# Install project dependencies
RUN composer install --no-interaction

# Set the correct permissions and ownership
RUN chmod -R 755 /var/www/html && chown -R www-data:www-data /var/www/html

# Set the ServerName directive
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Update Apache configuration to allow access and set DirectoryIndex
RUN echo "<Directory \"/var/www/html\">\n\tOptions Indexes FollowSymLinks\n\tAllowOverride None\n\tRequire all granted\n\tDirectoryIndex index.php index.html\n</Directory>" >> /etc/apache2/apache2.conf

# Define a DocumentRoot for Apache
COPY apache2.conf /etc/apache2/sites-available/default.conf
RUN a2ensite default 

# Define environment variables (optional)
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
