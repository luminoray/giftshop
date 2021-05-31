release: composer install
release: composer update -a
release: npm install
release: npm run dev
release: php artisan migrate --seed
release: php artisan storage:link
release: php artisan l5-swagger:generate
web: vendor/bin/heroku-php-apache2 public/
