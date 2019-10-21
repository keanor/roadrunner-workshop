FROM php:cli

RUN apt-get update && apt-get install -y \
        curl libicu-dev

RUN docker-php-ext-install -j$(nproc) intl mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/blog

CMD [ "/var/www/blog/rr", "serve", "-d", "-v" ]