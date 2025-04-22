FROM php:7.2-fpm

ARG git_email="peto.krisztian@gmail.com"
ARG git_user="jesuschristiani"

ARG git_hub_token

RUN apt update \
    && apt install -y -f zlib1g-dev g++ git libicu-dev zip libzip-dev zip default-mysql-client libssl-dev acl procps \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure phar \
    && docker-php-ext-install phar \
    && docker-php-ext-enable phar

RUN curl -fsSL https://deb.nodesource.com/setup_23.x -o nodesource_setup.sh | bash
RUN apt install -y nodejs npm

# Seems like composer 2.3+ not compatible with symfony 3.4
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.2.13

# For composer git usage
RUN git config --global user.email ${git_email}
RUN git config --global user.name ${git_user}
RUN composer config -g github-oauth.github.com ${git_hub_token}
