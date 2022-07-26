<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/* |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- | | Here is where you can register all of the routes for an application. | It is a breeze. Simply tell Lumen the URIs it should respond to | and give it the Closure to call when that URI is requested. | */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "/v1"], function () use ($router) {

    $router->group(["prefix" => "/stock"], function () use ($router) {
            $router->post("/create", 'ProductController@createProduct');
            $router->get('/list', 'ProductController@getListProduct');
            $router->put("/{id}", 'ProductController@putProduct');
            $router->delete("/{id}", 'ProductController@deleteProduct');
            $router->get("/{id}/restore", 'ProductController@restoreProduct');
        }
        );
        $router->group(["prefix" => "/transaction"], function () use ($router) {
            $router->post("/create", 'TransactionController@createTransaction');
            $router->get('/list', 'TransactionController@getListTransaction');
            $router->put("/{id}", 'TransactionController@putTransaction');
            $router->delete("/{id}", 'TransactionController@deleteTransaction');
            $router->get("/{id}/restore", 'TransactionController@restoreTransactionss');
        }
        );
    });