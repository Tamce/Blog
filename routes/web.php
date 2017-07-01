<?php
/**
 * APIs
 */
$app->group(['prefix' => 'api'], function () use ($app) {
    $app->post('/login', ['uses' => 'User@login']);
    $app->group(['middleware' => 'auth'], function () use ($app) {
        $app->get('/logout', ['uses' => 'User@logout']);
        $app->get('/profile', ['uses' => 'User@profile']);

        $app->get('/posts', ['uses' => 'Post@read']);
        $app->post('/posts', ['uses' => 'Post@create']);
        $app->patch('/posts/{hash}', ['uses' => 'Post@update']);
        $app->get('/posts/{hash}', function ($hash) {
            return redirect('/posts?hash='.$hash);
        });
        $app->delete('/posts/{hash}', ['uses' => 'Post@delete']);
    });
});

/**
 * Front End
 */
$app->get('/', function () use ($app) {
    return $app->version();
});

