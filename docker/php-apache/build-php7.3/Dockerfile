FROM php:7.3-apache
MAINTAINER Maxim M <appved@yandex.ru>
ADD run_php_apache.sh /usr/bin/
RUN chmod +x /usr/bin/run_php_apache.sh
ENV HTTPD_HOST='localhost'
RUN apt-get update
RUN apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    gettext \
    libcurl4-gnutls-dev \
    curl \
    libzip-dev \
    mc
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli curl zip
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN useradd user && \
    sed -e 's/${APACHE_RUN_USER:=www-data}/${APACHE_RUN_USER:=user}/' -i /etc/apache2/envvars && \
    sed -e 's/${APACHE_RUN_GROUP:=www-data}/${APACHE_RUN_GROUP:=user}/' -i /etc/apache2/envvars

RUN docker-php-ext-install pdo_mysql

CMD ["/usr/bin/run_php_apache.sh"]
