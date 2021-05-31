composer install
composer update -a
npm install
npm run prod
php artisan migrate --seed
php artisan storage:link
php artisan l5-swagger:generate
