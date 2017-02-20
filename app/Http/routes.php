<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//静态页面
get('', 'StaticPagesController@home')->name('home');
get('help', 'StaticPagesController@help')->name('help');
get('about', 'StaticPagesController@about')->name('about');
get('blank', 'StaticPagesController@blank')->name('blank');

//用户操作
get('signup', 'UsersController@create')->name('signup');
resource('users', 'UsersController');
get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//登录登出
get('login', 'SessionsController@create')->name('login');
post('login', 'SessionsController@store')->name('login');
delete('login', 'SessionsController@destroy')->name('logout');

//重置密码
get('password/email', 'Auth\PasswordController@getEmail')->name('password.reset');
post('password/email', 'Auth\PasswordController@postEmail')->name('password.reset');
get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.edit');
post('password/reset', 'Auth\PasswordController@postReset')->name('password.update');

//微博操作
resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//粉丝系统
get('users/{id}/followings', 'UsersController@followings')->name('users.followings');
get('users/{id}/followers', 'UsersController@followers')->name('users.followers');
post('users/followers/{id}', 'FollowersController@store')->name('followers.store');
delete('users/followers/{id}', 'FollowersController@destroy')->name('followers.destroy');
