FROM php:8.0-fpm

RUN apt-get update && apt-get install -y  \
    git \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql -j$(nproc) gd

RUN docker-php-ext-enable pdo pdo_mysql

RUN apt-get update && apt-get install curl && \
  curl -sS https://getcomposer.org/installer | php \
  && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer
