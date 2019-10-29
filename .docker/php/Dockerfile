FROM php:cli

RUN apt-get update && apt-get install -y \
        curl libicu-dev

RUN docker-php-ext-install -j$(nproc) intl mysqli pdo_mysql sockets json

WORKDIR /var/www/blog

CMD [ "php" ]