FROM nginx:stable
MAINTAINER Maxim M <appved@yandex.ru>
ADD run_nginx.sh /usr/bin/
RUN chmod +x /usr/bin/run_nginx.sh
ENV NGINX_HOST='localhost'
CMD ["/usr/bin/run_nginx.sh"]