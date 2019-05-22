FROM php:7.1-apache
MAINTAINER Maxim M <appved@yandex.ru>
ADD run_php_apache.sh /usr/bin/
RUN chmod +x /usr/bin/run_php_apache.sh
ENV HTTPD_HOST='localhost'
RUN apt-get update
RUN apt-get install -y \
    gettext \
    curl \
    mc
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli
RUN useradd user && \
    sed -e 's/${APACHE_RUN_USER:=www-data}/${APACHE_RUN_USER:=user}/' -i /etc/apache2/envvars && \
    sed -e 's/${APACHE_RUN_GROUP:=www-data}/${APACHE_RUN_GROUP:=user}/' -i /etc/apache2/envvars
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

CMD ["/usr/bin/run_php_apache.sh"]