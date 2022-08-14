## INFO
Application with public api access.
Simple application for showing graphics collected using the Bitfinex API and tracks the bitcoin trades compared to USD. 
Subscribe for notified users when the price goes above the limit set by the user.

    - Start with:
        * git clone https://github.com/inikivanov/test.git {your folder name}

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

## .env
    - DB_DATABASE={db_name} - your DB name 
    - DB_USERNAME={username} - your DB username
    - DB_PASSWORD={password} - your DB password

    - APIDATA_SIMBOL=BTCUSD - or what we want to use - this is for bitcoin in usd - from https://docs.bitfinex.com/v1/referencerest-public-ticker#rest-public-ticker
    
    - IMPORTANT setup is mail in  .env file. I used settings from mailtrap.io to test mail sending.

    - APIDATA_SLEEP_TIMER_SENDING_MAIL=5 - This add because mailtrap has limit for receiving mails per seconds and send mails between 5 second when is set to 5 if we do need to use we can just set false or what seconds we need between mails

## Installation
    - composer install

    - we need setup db for usage before to go in .env
    - php artisan migrate

    - seed dummy data for table bitfinex - where we store data from external api https://api.bitfinex.com/v1/pubticker/{simbol}
        this will seed rows for one year for every day in year to one row
        * php artisan db:seed --class=ChartSeeder
    - seed dummy data for subscriptions table
        * php artisan db:seed --class=SubscribersSeeder

    - Or just run
        * php artisan db:seed


## Start app
    - php artisan serve

## Check comand for job and activate it for crontab - it's setup ->dayly() in /app/Console/Karnel.php
    - php artisan schedule:run
    
    - php artisan api:data-notify

    - If using mailtrap there is possible error return from Mailtrap with limit of 5 messages per seconds.

    - crontab -e
        * add this row in file and save it - This will start chron job on server
        - * * * * * cd /your-project-path && php artisan schedule:run >> /dev/null 2>&1

## public api urls to use in postman
    - GET - {your main app url}/api/chart - retrive data for chart.js 
    - POST - {your main app url}/api/subscribe-for-notifications - user can subscribe when the price goes above the limit set by the user
        * weit for 'email' and 'amount' from POST request form-data

## Test the app
    - php artisan test
    - testcases:
        * test return chart data - retrive charts data successfully
        * test command api:data-notify - console command runned from job in application
        * test insert chart data - insert new chart data bitfinex table
        * test subscribe a user without valid data - create new subscription without form data
        * test subscribe a user - insert in DB - create new subscription
        * test do not subscribe user twice - check exists - insert new chart data bitfinex table