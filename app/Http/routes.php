<?php


Event::listen('illuminate.query', function($query){
    var_dump($query);
});

Route::group(['middleware' => ['auth']], function(){

Route::get('/',                    ['as'=>'home.index',  'uses'=>'HomeController@index']);

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

    Route::group(['prefix' => 'funcionarios'], function(){

        Route::get('/',                ['as'=>'funcionario.index',  'uses'=>'FuncionarioController@index']);
        Route::get('/novo',            ['as'=>'funcionario.create', 'uses'=>'FuncionarioController@create']);
        Route::post('/gravar',         ['as'=>'funcionario.store',  'uses'=>'FuncionarioController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'funcionario.show',   'uses'=>'FuncionarioController@show']);
        Route::get('/editar/{id}',     ['as'=>'funcionario.edit',   'uses'=>'FuncionarioController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'funcionario.update', 'uses'=>'FuncionarioController@update']);
        Route::delete('/remover/{id}', ['as'=>'funcionario.delete', 'uses'=>'FuncionarioController@destroy']);

    });

    Route::group(['prefix' => 'data-shows'], function(){

        Route::get('/',                ['as'=>'data-show.index',  'uses'=>'DataShowController@index']);
        Route::get('/novo',            ['as'=>'data-show.create', 'uses'=>'DataShowController@create']);
        Route::post('/gravar',         ['as'=>'data-show.store',  'uses'=>'DataShowController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'data-show.show',   'uses'=>'DataShowController@show']);
        Route::get('/editar/{id}',     ['as'=>'data-show.edit',   'uses'=>'DataShowController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'data-show.update', 'uses'=>'DataShowController@update']);
        Route::delete('/remover/{id}', ['as'=>'data-show.delete', 'uses'=>'DataShowController@destroy']);

    });

    Route::group(['prefix' => 'mapas'], function(){

        Route::get('/',                ['as'=>'mapa.index',  'uses'=>'MapaController@index']);
        Route::get('/novo',            ['as'=>'mapa.create', 'uses'=>'MapaController@create']);
        Route::post('/gravar',         ['as'=>'mapa.store',  'uses'=>'MapaController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'mapa.show',   'uses'=>'MapaController@show']);
        Route::get('/editar/{id}',     ['as'=>'mapa.edit',   'uses'=>'MapaController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'mapa.update', 'uses'=>'MapaController@update']);
        Route::delete('/remover/{id}', ['as'=>'mapa.delete', 'uses'=>'MapaController@destroy']);

    });

    Route::group(['prefix' => 'salas'], function(){

        Route::get('/',                ['as'=>'sala.index',  'uses'=>'SalaController@index']);
        Route::get('/novo',            ['as'=>'sala.create', 'uses'=>'SalaController@create']);
        Route::post('/gravar',         ['as'=>'sala.store',  'uses'=>'SalaController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'sala.show',   'uses'=>'SalaController@show']);
        Route::get('/editar/{id}',     ['as'=>'sala.edit',   'uses'=>'SalaController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'sala.update', 'uses'=>'SalaController@update']);
        Route::delete('/remover/{id}', ['as'=>'sala.delete', 'uses'=>'SalaController@destroy']);

    });

    Route::group(['prefix' => 'reserva-recurso'], function(){

        Route::get('/',                ['as'=>'reserva-recurso.index',  'uses'=>'ReservaRecursoController@index']);
        Route::get('/eventos',         ['as'=>'reserva-recurso.data',   'uses'=>'ReservaRecursoController@getData']);
        Route::get('/novo',            ['as'=>'reserva-recurso.create', 'uses'=>'ReservaRecursoController@create']);
        Route::post('/gravar',         ['as'=>'reserva-recurso.store',  'uses'=>'ReservaRecursoController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'reserva-recurso.show',   'uses'=>'ReservaRecursoController@show']);
        Route::get('/editar/{id}',     ['as'=>'reserva-recurso.edit',   'uses'=>'ReservaRecursoController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'reserva-recurso.update', 'uses'=>'ReservaRecursoController@update']);
        Route::delete('/remover/{id}', ['as'=>'reserva-recurso.delete', 'uses'=>'ReservaRecursoController@destroy']);

    });
});

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@loginCustom');
Route::get('logout', 'Auth\AuthController@logout');

// API Gráficos
Route::group(['prefix' => 'chart'], function(){

    Route::get('/sumarizacao', ['as'=>'chart.sumarizacao', 'uses'=>'ApiGraphController@sumarizarLogs']);

});