FROM php:7-cli

RUN apt-get update && apt-get install -y git \
	&& apt-get install -y libpq-dev libzip-dev --no-install-recommends \ 
	&& rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install pdo pdo_mysql \
    && mkdir -p /var/www/html/twitle
RUN git clone https://github.com/gabrielalan/twitle.git /var/www/html/twitle
RUN cd /var/www/html/twitle \
 	&& curl -s https://getcomposer.org/installer | php \
	&& php composer.phar install

VOLUME [ "/var/www/html/twitle" ]
WORKDIR /var/www/html/twitle

EXPOSE 90

CMD php -S 0.0.0.0:90 -t /var/www/html/twitle /var/www/html/twitle/index.php