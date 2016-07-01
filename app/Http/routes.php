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

Route::get('/', function () {
    return view('welcome');
});

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