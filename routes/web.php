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

$router->get("api/".env("VERSION"), function(){
    return response()->json([
        "path" => "/api/v1/"
        ],
        400
    );
});

$router->group(["prefix" => "api/".env("VERSION")], function($router){
    $router->get("article", "ArticleController@index");
    $router->get("article/{id}", "ArticleController@getArticleById");
    $router->post("article", "ArticleController@createArticle");
    $router->put("article/{id}", "ArticleController@updateArticle");
    $router->delete("article/{id}", "ArticleController@deleteArticle");
});