FROM php:7.4-apache
MAINTAINER Alex <alex@melentev.net>

# install utilities (system update and some packages (zlib1g-dev, libzip-dev, libpng-dev for php gd extension)
RUN apt-get update \
    && apt-get install -y \
    wget git unzip libzip-dev libpng-dev

# add apache modules
RUN a2enmod rewrite && a2enmod macro

# install composer globally
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# install php modules
# xdebug
RUN pecl install xdebug-2.9.4 \
    && docker-php-ext-enable xdebug

# mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# pdo
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo pdo_mysql

# gd
RUN docker-php-ext-install gd && docker-php-ext-enable gd

# zip
RUN docker-php-ext-install zip && docker-php-ext-enable zip

# symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony