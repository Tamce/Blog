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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('/login', ['uses' => 'User@login']);

$app->group(['middleware' => 'auth'], function () use ($app) {
    $app->get('/logout', ['uses' => 'User@logout']);

    $app->get('/profile', ['uses' => 'User@profile']);
});
