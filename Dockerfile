FROM php:8.3-apache

# Create a directory for the application code
WORKDIR /var/www/html

# Clone the application code from the Git repository
RUN git clone https://github.com/Praveenkumar90400/projectSangam.git

# Copy the application code to the document root
COPY . .

# Install Composer dependencies
RUN composer install --ignore-platform-reqs

# Expose the Apache port
EXPOSE 80

# Run the Apache server
CMD ["apache2", "-f", "-H"]
