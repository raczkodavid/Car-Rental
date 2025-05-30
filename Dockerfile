FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-interaction --no-dev --prefer-dist

# Copy the rest of the application
COPY . .

# Configure Apache DocumentRoot to point to public directory
RUN sed -i 's/\/var\/www\/html/\/var\/www\/html\/public/g' /etc/apache2/sites-available/000-default.conf

# Make sure the storage directories are writable
RUN chmod -R 775 src/Models/Data

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
