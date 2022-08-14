## INFO
Application with public api access.
Simple application for showing graphics collected using the Bitfinex API and tracks the bitcoin trades compared to USD. 
Subscribe for notified users when the price goes above the limit set by the user.

## Reqirements
My operation system is Ubuntu 22.04. 
With this requirements will work anyware.

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

* need setup db for usage before to go in .env

php artisan migrate

## Start app
php artisan serve

## Check comand for job and activate it for crontab - it's setup ->dayly() in /app/Console/Karnel.php
php artisan api:data-notify

crontab -e
add this row in file and save it - This will start chron job on server
* * * * * cd /your-project-path && php artisan schedule:run >> /dev/null 2>&1

## public api urls to use in postman
    - GET - {your main app url}/api/chart - retrive data for chart.js 
    - POST - {your main app url}/api/subscribe-for-notifications - user can subscribe when the price goes above the limit set by the user
        * weit for 'email' and 'amount' from POST request form-data

## .env
    - DB_DATABASE={db_name} - your DB name 
    - DB_USERNAME={username} - your DB username
    - DB_PASSWORD={password} - your DB password

    - APIDATA_SIMBOL=BTCUSD - or what we want to use - this is for bitcoin in usd - from https://docs.bitfinex.com/v1/referencerest-public-ticker#rest-public-ticker
    
    - The other is setup for mail - this is important. I use settings from mailtrap.io to test mail sending

## Test the app
    - first setup APP_ENV from local to testing
    - setup phpunit.xml
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
    - testcases:
        * test return chart data
        * test subscribe a user
        * test receive and insert chart data
        * test send mail to subscribers