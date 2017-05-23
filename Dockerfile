FROM php:5.6-cli
RUN apt-get update && apt-get install -y libssl-dev git && \
    pecl install mongo && docker-php-ext-enable mongo && \
    pecl install mongodb && docker-php-ext-enable mongodb && \
    docker-php-ext-install -j$(nproc) zip
