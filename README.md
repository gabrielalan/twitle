# Twitle
Twitle is a little Twitter made in PHP, with Silex and Doctrine.

## Install

### Install Composer
```
curl -s https://getcomposer.org/installer | php
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