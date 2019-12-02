<?php

//generador de llaves
// $router->get('/key', function(){

//     return str_random(32);

// });


// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });


$router->group(['prefix' => 'api', 'middleware' => 'auth'], function() use ($router){

    $router->get('authors', 'AuthorController@showAllAuthors');

    $router->get('authors/{id}', 'AuthorController@showOneAuthor');

    $router->post('authors/create', 'AuthorController@create');

    $router->put('authors/{id}', 'AuthorController@update');

    $router->delete('authors/{id}', 'AuthorController@delete');

});
