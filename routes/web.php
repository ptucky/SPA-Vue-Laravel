<?php
/* 
// (Pravee) change not conflict with route.js
Route::get('/', function () {
    return view('home');
}); 
*/

Route::get('{any}', function () {
    return view('home');
})->where('any', '.*');

Route::post('/images-upload', 'ImagesController@upload');

//Run command > php artisan storage:link
// storage for display
Route::get('storage/{filename}', function ($filename)
{
    return Image::make(storage_path('public/' . $filename))->response();
});