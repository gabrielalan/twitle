[![Build Status](https://travis-ci.org/gabrielalan/twitle.svg?branch=master)](https://travis-ci.org/gabrielalan/twitle) [![Code Climate](https://codeclimate.com/github/gabrielalan/twitle/badges/gpa.svg)](https://codeclimate.com/github/gabrielalan/twitle)

# Twitle
Twitle is a little Twitter made in PHP, with Silex and Doctrine.

## Install

You can clone this repo, and follow the steps below.

### Install Composer
```
curl -s https://getcomposer.org/installer | php

php composer.phar install
```

### Database
Create an database without tables, and configure the file `src/Twitle/Config/configuration.php`

### Execute doctrine to generate the tables
To execute the command below, you must be at the project folder.

Linux
```
./vendor/bin/doctrine orm:schema-tool:create
```

Windows
```
"vendor/bin/doctrine" orm:schema-tool:create
```

## Run

To run the app, use the PHP Built In Server passing index.php as the router:
```
php -S localhost:8888 index.php
```

## Run on Docker

Its possible run the app on docker container too, **but you need to configure database connection on `src/Twitle/Config/configuration.php` inside the container yet** pointing to your server.

Install docker, enter on ./docker, build the image, run and start the php built in server:
```
docker build -t twitle .

docker run -p 90:90 -it twitle bash

$ php -S 0.0.0.0:90 -t /var/www/html/twitle /var/www/html/twitle/index.php
```