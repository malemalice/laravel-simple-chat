# laravel-simple-chat
Laravel example status update app using simple laravel auth


## Installation
set your database connection and APP_URL edit .env file
```php
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:rGga+bDuoJwohKFUt5UMVrsNAkykfD0e9Ay6hjRztgQ=
APP_URL=http://localhost:8888/DEMO/pixel/chat

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=8889
DB_DATABASE=pixel_chat_2
DB_USERNAME=root
DB_PASSWORD=root
```
install dependency
```php
composer update
```
Run database migration
```php
php artisan migrate
```
prepare autoload and clear cache 
```php
php artisan config:cache
composer dump-optimize
php artisan optimize
```
access app via public url eg. http://localhost/chat/public/


Thanks, 
hope this inspire you
