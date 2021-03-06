<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

    use Laravel\Lumen\Routing\Router;

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    $router->get('get-available-rooms', 'RoomController@getAvailableRooms');
    $router->get('get-categories', 'RoomController@getCategories');
    $router->post('check-availability', 'RoomController@checkAvailability');
    $router->post('make-booking', 'RoomController@makeBooking');

    $router->post('login', 'UserController@doLogin');
    $router->post('signup', 'UserController@doSignup');
