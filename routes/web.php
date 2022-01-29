<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'auth'], function () use ($router){
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

});

// Portofolio
Route::group(['middleware' => ['auth']], function ($router) {
    $router->get('/portfolio', 'PortofolioController@index');
    $router->get('/portfolio/getById/{id}', 'PortofolioController@getById');
    $router->post('/portfolio/create', 'PortofolioController@create');
    $router->put('/portfolio/update/{id}', 'PortofolioController@updateById');
    $router->delete('/portfolio/delete/{id}', 'PortofolioController@deleteById');
});


// Performa
Route::group(['middleware' => ['auth']], function ($router) {
    $router->get('/performa', 'PerformaController@index');
    $router->get('/performa/getById/{id}', 'PerformaController@getById');
    $router->post('/performa/create', 'PerformaController@create');
});



$router->post('/upload', 'ImageController@upload');
$router->get('send_email' ,'Mailcontroller@mail');
