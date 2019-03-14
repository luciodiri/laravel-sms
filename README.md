# Log table example

## Description
This program pulls and displays results from an SMS messages success/failure tracking.

Watch demo at: https://luciodiri-sms.herokuapp.com/

#### Environment:
PHP7.2 on Apache 2. Laravel 5.7 with mysql DB 

#### Notes:
Using SQL raw queries for main log table data.
using Laravel Eloquent ORM for Filling filters data.

**Interesting work is done at:**
* Model: app/SendLog.php (logs Query)
* Controller: app/http/controllers/SendLogsController
* View: resources/views/send_log.bladed.php

### Setup:
* git Pull
* Run composer update
* setup DB connection at .env file
* Create the database- run: php artisan migrate.
 (migration files are at **database/migrations**)
* Fill the database with Fake content by loading [site-url]/create-data
(you can change the desired records number at app/http/controllers/**createDataController**)
* That's it, Go to site root and search the logs

*set config/database.php mysql strict mode to false.
to prevent ONLY_FULL_GROUP_BY MySQL mode.