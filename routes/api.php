<?php
use Illuminate\Http\Request;

/** 
 * login path
 * yourdomain.com/api/auth/login
*/

Route::post('register', 'UserController@register');
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::get('imageGallery/{userId}', 'UserController@getUserGallery');
Route::post('imageGallery', 'UserController@addUserGallery');
Route::delete('imageGallery/{id}/{userId}', 'UserController@deleteUserGallery');
Route::get('diskUsage/{userId}', 'UserController@getDiskUsage');