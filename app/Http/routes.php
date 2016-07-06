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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',                ['as'=>'home.index',  'uses'=>'HomeController@index']);

Route::group(['prefix' => 'editoras'], function(){

    Route::get('/',                ['as'=>'editora.index',  'uses'=>'EditoraController@index']);
    Route::get('/novo',            ['as'=>'editora.create', 'uses'=>'EditoraController@create']);
    Route::post('/gravar',         ['as'=>'editora.store',  'uses'=>'EditoraController@store']);
    Route::get('/detalhes/{id}',   ['as'=>'editora.show',   'uses'=>'EditoraController@show']);
    Route::get('/editar/{id}',     ['as'=>'editora.edit',   'uses'=>'EditoraController@edit']);
    Route::put('/atualizar/{id}',  ['as'=>'editora.update', 'uses'=>'EditoraController@update']);
    Route::delete('/remover/{id}', ['as'=>'editora.delete', 'uses'=>'EditoraController@destroy']);

});

Route::group(['prefix' => 'livros'], function(){

    Route::get('/',                ['as'=>'livro.index',  'uses'=>'LivroController@index']);
    Route::get('/novo',            ['as'=>'livro.create', 'uses'=>'LivroController@create']);
    Route::post('/gravar',         ['as'=>'livro.store',  'uses'=>'LivroController@store']);
    Route::get('/detalhes/{id}',   ['as'=>'livro.show',   'uses'=>'LivroController@show']);
    Route::get('/editar/{id}',     ['as'=>'livro.edit',   'uses'=>'LivroController@edit']);
    Route::put('/atualizar/{id}',  ['as'=>'livro.update', 'uses'=>'LivroController@update']);
    Route::delete('/remover/{id}', ['as'=>'livro.delete', 'uses'=>'LivroController@destroy']);

});

Route::group(['prefix' => 'revistas'], function(){

    Route::get('/',                ['as'=>'revista.index',  'uses'=>'RevistaController@index']);
    Route::get('/novo',            ['as'=>'revista.create', 'uses'=>'RevistaController@create']);
    Route::post('/gravar',         ['as'=>'revista.store',  'uses'=>'RevistaController@store']);
    Route::get('/detalhes/{id}',   ['as'=>'revista.show',   'uses'=>'RevistaController@show']);
    Route::get('/editar/{id}',     ['as'=>'revista.edit',   'uses'=>'RevistaController@edit']);
    Route::put('/atualizar/{id}',  ['as'=>'revista.update', 'uses'=>'RevistaController@update']);
    Route::delete('/remover/{id}', ['as'=>'revista.delete', 'uses'=>'RevistaController@destroy']);

});

Route::group(['prefix' => 'autores'], function(){

    Route::get('/',                ['as'=>'autor.index',  'uses'=>'AutorController@index']);
    Route::get('/novo',            ['as'=>'autor.create', 'uses'=>'AutorController@create']);
    Route::post('/gravar',         ['as'=>'autor.store',  'uses'=>'AutorController@store']);
    Route::get('/detalhes/{id}',   ['as'=>'autor.show',   'uses'=>'AutorController@show']);
    Route::get('/editar/{id}',     ['as'=>'autor.edit',   'uses'=>'AutorController@edit']);
    Route::put('/atualizar/{id}',  ['as'=>'autor.update', 'uses'=>'AutorController@update']);
    Route::delete('/remover/{id}', ['as'=>'autor.delete', 'uses'=>'AutorController@destroy']);

});