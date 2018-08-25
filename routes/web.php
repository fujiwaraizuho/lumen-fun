<?php

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

$router->get(env("VERSION"), function(){
    return response()->json(
        ['error' => 'Unauthorized'],
        401,
        ['X-Header-One' => 'Header Value']
    );
});

$router->get(env("VERSION")."/articles", "ArticleController@get");
$router->get(env("VERSION")."/articles/{id}", "ArticleController@getById");