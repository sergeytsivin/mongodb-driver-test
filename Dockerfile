FROM php:5.6-cli
RUN apt-get update && apt-get install -y libssl-dev git
RUN pecl install mongodb && docker-php-ext-enable mongodb