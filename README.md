# GiftShop
 
## Installation
This guide assumes you already have Apache, PHP, Postgresql, Composer, Node and NPM installed.

Place the project files in a location in your web server.

In apache's httpd.conf, update the DocumentRoot to the project's /public directory. Do the same for the Directory
configurations just below.

In the same Directory configurations in httpd.conf, change to AllowOverride All.

In the same file, enable mod_rewrite.so.

In php.ini, enable the extensions fileinfo and pdo_pgsql.

In the project's root, copy .env.example and rename it to .env

Navigate to the project's root in your terminal and run the following command to generate your App Key:
```text
php artisan key:generate
```

Open the .env file in your text editor, and update the database values to your database connection information.
Don't forget to also update APP_ENV, APP_DEBUG, and APP_URL to match with your server's configuration.

Navigate to the project's root in your terminal and run the following commands:
```text
composer install
composer update -a
npm install
npm run prod
php artisan migrate --seed
php artisan storage:link
```

The default admin account credentials are:
```text
email: admin@giftshop.com
password: password
```

The app should now be ready to use!
