# Use PHP 7.2 FPM as the base image
FROM php:7.2-fpm

# Set the environment to non-interactive for package installations
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
        git \
        curl \
        unzip \
        libxml2-dev \
        unixodbc-dev \
        libcurl4-openssl-dev \
        libzip-dev \
        libicu-dev \
        libpng-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        gnupg && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) xml mbstring curl zip intl soap bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install the Microsoft ODBC driver for SQL Server and required dependencies
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17 unixodbc-dev

# Install the sqlsrv and pdo_sqlsrv extensions
RUN pecl install sqlsrv-5.2.0 pdo_sqlsrv-5.2.0

# Enable the sqlsrv and pdo_sqlsrv extensions
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

# Ensure PHP-FPM listens on port 9000
RUN sed -i 's|^listen = .*|listen = 0.0.0.0:9000|' /usr/local/etc/php-fpm.d/www.conf

# Set the working directory
WORKDIR /var/www

# Copy the source code to the container
COPY ./boughts /var/www

# Create the directory for the PHP-FPM socket
RUN mkdir -p /run/php

# Adjust permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data /var/www/storage && chmod -R 775 /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache && chmod -R 775 /var/www/bootstrap/cache

# Disable the default Nginx configuration script if it exists
RUN if [ -f /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh ]; then rm /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh; fi

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Set the default command to run php-fpm
CMD ["php-fpm", "-F"]