# SPA-Vue-Laravel

Simple Image Gallery (Vue.Js2 + Laravel 5.6.39)


[![VDO](https://firebasestorage.googleapis.com/v0/b/look24-notification.appspot.com/o/img-youtube.png?alt=media&token=5731f503-e934-4f9d-8587-3c0e6d057a38)](https://youtu.be/HGjzpV7ah3U)


![2018-11-23](https://firebasestorage.googleapis.com/v0/b/look24-notification.appspot.com/o/OblongElasticAcouchi-size_restricted.gif?alt=media&token=b92685fa-a187-4bd2-8162-b2a030f4162b)

## Conponenets

- Vue Router
- Vuex
- JWT (Json Web Token) https://jwt-auth.readthedocs.io/en/develop/laravel-installation/

  ```bash
   composer require tymon/jwt-auth
  ```

- vue-toastr (Toast popup)
  ```bash
   npm install vue-toastr@latest --save
  ```

## Instruction

```bash
### go into the project
cd YOUR_PROJECT

### create a .env file
cp .env.example .env

### install composer dependencies
composer update

### install jwt-auth
composer require tymon/jwt-auth

### install npm dependencies
npm install

### Install Toast
npm install vue-toastr@latest --save

### Install kightbox
npm install vue-image-lightbox vue-lazyload

### generate a key for your application
php artisan key:generate

### generate Server secret for JWT
php artisan jwt:secret

### create a local MySQL database (make sure you have MySQL up and running)
mysql -u root

> create database YOUR_DB_NAME;
> exit;

### add the database connection config to your .env file
DB_CONNECTION=mysql
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=root
DB_PASSWORD=

### run the migration files to generate the schema
php artisan migrate

### Important ! make storage seem link
php artisan storage:link

### Start
php artisan serve

### run webpack and watch for changes
npm run watch
```
