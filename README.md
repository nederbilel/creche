rmdir /s /q vendor
del composer.lock
composer install
composer clear-cache
php artisan key:generate



php artisan db:seed --class=UsersTableSeeder
php artisan migrate
php artisan storage:link

php artisan serve --host=192.168.247.36 --port=8000
