FROM php:7.4-apache

RUN apt-get update && \
apt-get install -y \curl \ssmtp
RUN rm -rf /var/lib/apt/lists/*
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h
RUN docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install mysqli

    # docker-php-ext-install ldap && \
    # docker-php-ext-configure mysql --with-mysql=mysqlnd && \
    # docker-php-ext-configure mysqli --with-mysqli=mysqlnd && \
    # docker-php-ext-install mysqli && \
    # docker-php-ext-install mysql && \
    # docker-php-ext-install soap && \
    # docker-php-ext-install intl && \
    # docker-php-ext-install mcrypt && \
    # docker-php-ext-install gd && \
    # docker-php-ext-install gmp && \
    # docker-php-ext-install zip

COPY ./src/ /var/www/html

CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground





# RUN docker-php-ext-install pdo pdo_mysql