FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev \
    nodejs \

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath mysqli zip gd pcntl posix

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

WORKDIR /var/www
USER $user
