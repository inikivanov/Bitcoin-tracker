## Reqirements
* Apache2
Server version: Apache/2.4.52 (Ubuntu)
Server built:   2022-06-14T12:30:21

* PHP
PHP 8.1.8 (cli) (built: Jul 11 2022 08:30:39) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.8, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.8, Copyright (c), by Zend Technologies

* MySql
mysql  Ver 8.0.30-0ubuntu0.22.04.1 for Linux on x86_64 ((Ubuntu))

## Install Commands
composer install

* need db with name ampeco_be or what you set in .env

php artisan migrate

## Check job and activate - it setup ->dayly() in /app/Console/Karnel.php
php artisan api:data

crontab -e

* * * * * cd /your-project-path && php artisan schedule:run >> /dev/null 2>&1

## public api urls
    - GET - {your main app url}/api/chart - retrive data for chart.js 
    - POST - {your main app url}/api/subscribe-for-notifications - user can subscribe when the price goes above the limit set by the user
        * weit for 'email' and 'amount'

## .env
* DB_DATABASE=ampeco_be - is the db in my local enviroment
* DB_USERNAME={username} - here is your username
* DB_PASSWORD={password} - your password

* APIDATA_SIMBOL=BTCUSD - or what we want to use - this is for bitcoin in usd - from https://docs.bitfinex.com/v1/reference/rest-public-ticker#rest-public-ticker
    - The other is setup for mail - this is important. I use settings from mailtrap.io
