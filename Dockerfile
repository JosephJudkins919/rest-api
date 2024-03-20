# Use PHP runtime as a parent image
FROM php:8.2-apache

# Install required system packages
RUN sed -i 's/deb.debian.org/mirrors.ubuntu.com/mirrors.ubuntu.com/g' /etc/apt/sources.list && \
    apt-get update && \
    apt-get install -y libpq-dev && \
    rm -rf /var/lib/apt/lists/*

# Set working directory in container
WORKDIR /var/www/html

# Copy current directory contents into container
COPY . /var/www/html

# Adding Postgres support
RUN docker-php-ext-install pdo_pgsql

# Copy Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Expose port 80 to allow connections
EXPOSE 80

