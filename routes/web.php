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