FROM php:8.2-fpm

# Arguments for user setup
ARG user=www-data
ARG uid=1000

# Set up user
#RUN echo "Adding user ${user} with UID ${uid}" \
RUN mkdir -p /home/${user} \
    && chown -R ${uid}:${uid} /home/${user}

RUN chown -R ${user}:${user} /var/www

# Update and install dependencies
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    nano \
    default-libmysqlclient-dev  # Add this for MySQL support

# Clean up after installation
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd pdo_mysql  # Add pdo_mysql here

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /srv/www/app

# Switch to the non-root user
USER $user
