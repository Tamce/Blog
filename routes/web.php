<?php
use Tamce\Renderer;
/**
 * APIs
 */
$app->group(['prefix' => 'api'], function () use ($app) {
    $app->post('/login', ['uses' => 'User@login']);
    $app->get('/posts', ['uses' => 'Post@read']);
    $app->get('/posts/{hash}', function ($hash) {
        return redirect('/posts?hash='.$hash);
    });
    $app->group(['middleware' => 'auth'], function () use ($app) {
        $app->get('/logout', ['uses' => 'User@logout']);
        $app->get('/profile', ['uses' => 'User@profile']);
        $app->post('/posts', ['uses' => 'Post@create']);
        $app->patch('/posts/{hash}', ['uses' => 'Post@update']);
        $app->delete('/posts/{hash}', ['uses' => 'Post@delete']);
    });
});

/**
 * Front End
 */
$app->get('/modules/{name}', function ($name) {
    try {
        Renderer::render('modules/'.$name.'.vue');
    } catch (\Exception $e) {
        abort(404);
    }
});
$app->get('/', function () {
    Renderer::render('index');
});
$app->get('{any:.*}', function () {
    Renderer::render('index');
});

