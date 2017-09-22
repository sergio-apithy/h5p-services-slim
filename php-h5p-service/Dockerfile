FROM php:fpm

ENV PHP_IDE_CONFIG="serverName=DockerPhp"

RUN apt-get update
RUN apt-get install -y zlib1g-dev
RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Install composer
WORKDIR /
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# Verify signature, update this if you get corrupt installer message
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

RUN composer global require "laravel/installer"
ENV PATH=$PATH:/root/.composer/vendor/bin

WORKDIR /var/www/html

RUN ["chmod", "+x", "/var/www/html"]