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

# The API

## `GET` /rest/v1/entries
Return all added entries

### Responses

Code | Description | Schema
---- | ----------- | --------
200 | Success | `{"result":	[Entry, ...], "errors":	[], "success": true}`
500 | An error ocurred | `{"result":	[], "errors":	[Error, ...], "success": false}`

## `POST` /rest/v1/entries
Add an entry to the system

### Parameters

Name | Located in | Description | Required | Schema
---- | ---------- | ----------- | -------- | ------
Data | Body | Entry data | Yes | `{"author":"Name", "text":"Text for twitle"}`

### Responses

Code | Description | Schema
---- | ----------- | --------
200 | Success added | `{"result":	Entry {}, "errors":	[], "success": true}`
500 | An error ocurred | `{"result": [], "errors":	[Error, ...], "success": false}`

## `DELETE` /rest/v1/entries/{id}
Remove an entry of the system

### Parameters

Name | Located in | Description | Required | Schema
---- | ---------- | ----------- | -------- | ------
Id | URI | Entry id | Yes | `/{number}`

### Responses

Code | Description | Schema
---- | ----------- | --------
200 | Success removed | `{"result":	true, "errors":	[], "success": true}`
500 | An error ocurred | `{"result": [], "errors":	[Error, ...], "success": false}`

# Run on Docker

**If you don't want to have difficults editing the `configuration.php` to put your db data, this is not recommended. You'll need to install vi or vim to edit the file, and take sure that your database is accessible by the container.**

Its possible run the app on docker container too, **but you need to configure database connection on `src/Twitle/Config/configuration.php` inside the container yet** pointing to your server.

Install docker, enter on ./docker, build the image, run and start the php built in server:
```
docker build -t twitle .

docker run -p 90:90 -it twitle bash

$ php -S 0.0.0.0:90 -t /var/www/html/twitle /var/www/html/twitle/index.php
```
