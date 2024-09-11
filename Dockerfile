# Use Ubuntu 20.04 as the base image
FROM ubuntu:20.04

# Set the environment to non-interactive for package installations
ENV DEBIAN_FRONTEND=noninteractive

# Add the PHP 7.2 repository and install PHP-FPM and its extensions
RUN apt-get update && apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y \
    php7.2-fpm \
    php7.2-cli \
    php7.2-mysql \
    php7.2-xml \
    php7.2-mbstring \
    php7.2-curl \
    php7.2-zip \
    php7.2-intl \
    php7.2-soap \
    php7.2-bcmath \
    php7.2-gd \
    php-pear \
    php7.2-dev \
    curl \
    git \
    unzip \
    libxml2-dev \
    unixodbc-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Verify the installation of php-fpm
RUN which php-fpm7.2 && php-fpm7.2 -v

# Set the working directory
WORKDIR /var/www

# Copy the source code to the container
COPY ./boughts /var/www

# Create the directory for the PHP-FPM socket
RUN mkdir -p /run/php
# Ensure PHP-FPM listens on port 9000
RUN sed -i 's|^listen = .*|listen = 0.0.0.0:9000|' /etc/php/7.2/fpm/pool.d/www.conf

# Adjust permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data /var/www/storage && chmod -R 775 /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache && chmod -R 775 /var/www/bootstrap/cache


# Disable the default Nginx configuration script if it exists
RUN if [ -f /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh ]; then rm /docker-entrypoint.d/10-listen-on-ipv6-by-default.sh; fi

# Install the Microsoft ODBC driver for SQL Server and required dependencies
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17 unixodbc-dev

# Install the sqlsrv and pdo_sqlsrv extensions
RUN pecl install sqlsrv-5.2.0
RUN pecl install pdo_sqlsrv-5.2.0


# RUN pecl install sqlsrv pdo_sqlsrv

# Enable the sqlsrv and pdo_sqlsrv extensions
RUN echo "extension=sqlsrv.so" > /etc/php/7.2/cli/conf.d/20-sqlsrv.ini && \
    echo "extension=pdo_sqlsrv.so" > /etc/php/7.2/cli/conf.d/20-pdo_sqlsrv.ini && \
    echo "extension=sqlsrv.so" > /etc/php/7.2/fpm/conf.d/20-sqlsrv.ini && \
    echo "extension=pdo_sqlsrv.so" > /etc/php/7.2/fpm/conf.d/20-pdo_sqlsrv.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php


# Set the default command to run php-fpm
CMD ["php-fpm7.2", "-F"]