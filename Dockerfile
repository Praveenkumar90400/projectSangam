# Use an official PHP image as the base
FROM php:8.3-apache

# Create a directory for the application code
WORKDIR /var/www/html

# Clone the application code from the Git repository
RUN git clone https://github.com/Praveenkumar90400/projectSangam.git

# Copy the application code to the document root
COPY . .

# Install Composer dependencies
RUN composer install --ignore-platform-reqs
# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose the Apache port
EXPOSE 80

# Run the Apache server
CMD ["apache2", "-f", "-H"]
