# SPA-Vue-Laravel
Simple Image Gallery (Vue.Js2 + Laravel 5.6.39)


```bash
# go into the project
cd YOUR_PROJECT

# create a .env file
cp .env.example .env

# install composer dependencies
composer update

composer require tymon/jwt-auth

# install npm dependencies
npm install

npm install vue-toastr@latest --save

# generate a key for your application
php artisan key:generate

# generate Server secret for JWT
php artisan jwt:secret

# create a local MySQL database (make sure you have MySQL up and running)
mysql -u root

> create database YOUR_DB_NAME;
> exit;

# add the database connection config to your .env file
DB_CONNECTION=mysql
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=root
DB_PASSWORD=

# run the migration files to generate the schema
php artisan migrate


# run webpack and watch for changes
npm run watch
```