<?php

Route::group(['middleware' => ['auth']], function(){

Route::get('/',                        ['as'=>'home.index',  'uses'=>'HomeController@index']);

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

    Route::group(['prefix' => 'alunos'], function(){

        Route::get('/',                ['as'=>'aluno.index',  'uses'=>'AlunoController@index']);
        Route::get('/novo',            ['as'=>'aluno.create', 'uses'=>'AlunoController@create']);
        Route::post('/gravar',         ['as'=>'aluno.store',  'uses'=>'AlunoController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'aluno.show',   'uses'=>'AlunoController@show']);
        Route::get('/editar/{id}',     ['as'=>'aluno.edit',   'uses'=>'AlunoController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'aluno.update', 'uses'=>'AlunoController@update']);
        Route::delete('/remover/{id}', ['as'=>'aluno.delete', 'uses'=>'AlunoController@destroy']);

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
        Route::post('/gravar',         ['as'=>'reserva-recurso.store',  'uses'=>'ReservaRecursoController@store']);
        Route::post('/atualizar',      ['as'=>'reserva-recurso.update', 'uses'=>'ReservaRecursoController@update']);
        Route::delete('/remover/{id}', ['as'=>'reserva-recurso.delete', 'uses'=>'ReservaRecursoController@destroy']);

    });

    Route::group(['prefix' => 'turmas'], function(){

        Route::get('/',                        ['as'=>'turma.index',    'uses'=>'TurmaController@index']);
        Route::get('/vincular-alunos/{id}',    ['as'=>'turma.vinculo',  'uses'=>'TurmaController@vinculo']);
        Route::post('/vincular',               ['as'=>'turma.vincular', 'uses'=>'TurmaController@vincular']);
        Route::get('/alunos-vinculados/{id}',  ['as'=>'turma.aluno',    'uses'=>'TurmaController@vinculados']);
        Route::get('/novo',                    ['as'=>'turma.create',   'uses'=>'TurmaController@create']);
        Route::post('/gravar',                 ['as'=>'turma.store',    'uses'=>'TurmaController@store']);
        Route::get('/detalhes/{id}',           ['as'=>'turma.show',     'uses'=>'TurmaController@show']);
        Route::get('/editar/{id}',             ['as'=>'turma.edit',     'uses'=>'TurmaController@edit']);
        Route::put('/atualizar/{id}',          ['as'=>'turma.update',   'uses'=>'TurmaController@update']);
        Route::delete('/remover/{id}',         ['as'=>'turma.delete',   'uses'=>'TurmaController@destroy']);
        Route::delete('/remover-alunos/{id}',  ['as'=>'turma.remove',   'uses'=>'TurmaController@destroyVinculo']);

    });

    Route::group(['prefix' => 'emprestimos'], function(){

        Route::get('/',                ['as'=>'emprestimo.index',    'uses'=>'EmprestimoController@index']);
        Route::get('/novo',            ['as'=>'emprestimo.create',   'uses'=>'EmprestimoController@create']);
        Route::post('/gravar',         ['as'=>'emprestimo.store',    'uses'=>'EmprestimoController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'emprestimo.show',     'uses'=>'EmprestimoController@show']);
        Route::get('/editar/{id}',     ['as'=>'emprestimo.edit',     'uses'=>'EmprestimoController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'emprestimo.update',   'uses'=>'EmprestimoController@update']);
        Route::delete('/remover/{id}', ['as'=>'emprestimo.delete',   'uses'=>'EmprestimoController@destroy']);
        Route::put('/devolver/{id}',   ['as'=>'emprestimo.devolver', 'uses'=>'EmprestimoController@devolverEmprestimo']);

    });

    Route::group(['prefix' => 'reservas'], function(){

        Route::get('/',                ['as'=>'reserva.index',    'uses'=>'ReservaController@index']);
        Route::get('/novo',            ['as'=>'reserva.create',   'uses'=>'ReservaController@create']);
        Route::post('/gravar',         ['as'=>'reserva.store',    'uses'=>'ReservaController@store']);
        Route::get('/detalhes/{id}',   ['as'=>'reserva.show',     'uses'=>'ReservaController@show']);
        Route::get('/editar/{id}',     ['as'=>'reserva.edit',     'uses'=>'ReservaController@edit']);
        Route::put('/atualizar/{id}',  ['as'=>'reserva.update',   'uses'=>'ReservaController@update']);
        Route::delete('/remover/{id}', ['as'=>'reserva.delete',   'uses'=>'ReservaController@destroy']);

    });

    Route::group(['prefix' => 'logs'], function(){

        Route::get('/dashboard',       ['as'=>'log.index',     'uses'=>'LogController@index']);
        Route::get('/',                ['as'=>'log.list',      'uses'=>'LogController@listLogs']);
        Route::get('/{date}',          ['as'=>'log.show',      'uses'=>'LogController@show']);
        Route::get('/download/{date}', ['as'=>'log.download',  'uses'=>'LogController@download']);
        Route::get('/{date}/{level}',  ['as'=>'log.filter',    'uses'=>'LogController@showByLevel']);
        Route::delete('/delete',       ['as'=>'log.delete',    'uses'=>'LogController@delete']);

    });

    Route::group(['prefix' => 'relatorios'], function(){

        Route::get('/alunos-pendentes',                     ['as'=>'aluno.pendente',                'uses'=>'RelatorioController@alunosPendentes']);
        Route::get('/pdf-alunos-pendentes',                 ['as'=>'aluno.pendente.pdf',            'uses'=>'RelatorioController@gerarPDFAlunosPendentes']);
        Route::get('/baixar-alunos-pendentes',              ['as'=>'aluno.pendente.baixar',         'uses'=>'RelatorioController@baixarPDFAlunosPendentes']);

        Route::get('/funcionarios-pendentes',               ['as'=>'funcionario.pendente',          'uses'=>'RelatorioController@funcionariosPendentes']);
        Route::get('/pdf-funcionarios-pendentes',           ['as'=>'funcionario.pendente.pdf',      'uses'=>'RelatorioController@gerarPDFFuncionariosPendentes']);
        Route::get('/baixar-funcionarios-pendentes',        ['as'=>'funcionario.pendente.baixar',   'uses'=>'RelatorioController@baixarPDFFuncionariosPendentes']);

        Route::get('/publicacoes-emprestadas',              ['as'=>'publicacao.emprestada',         'uses'=>'RelatorioController@publicacoesMaisEmprestadas']);
        Route::get('/pdf-publicacoes-mais-emprestadas',     ['as'=>'publicacao.emprestada.pdf',     'uses'=>'RelatorioController@gerarPDFPublicacoesMaisEmprestadas']);
        Route::get('/baixar-publicacoes-mais-emprestadas',  ['as'=>'publicacao.emprestada.baixar',  'uses'=>'RelatorioController@baixarPDFPublicacoesMaisEmprestadas']);

        Route::get('/alunos-emprestimos',                   ['as'=>'aluno.emprestimo',              'uses'=>'RelatorioController@alunosComMaisEmprestimos']);
        Route::get('/pdf-alunos-mais-emprestimos',          ['as'=>'aluno.emprestimo.pdf',          'uses'=>'RelatorioController@gerarPDFAlunosComMaisEmprestimos']);
        Route::get('/baixar-alunos-mais-emprestimos',       ['as'=>'aluno.emprestimo.baixar',       'uses'=>'RelatorioController@baixarPDFAlunosComMaisEmprestimos']);

        Route::get('/funcionarios-emprestimos',             ['as'=>'funcionario.emprestimo',        'uses'=>'RelatorioController@funcionariosComMaisEmprestimos']);
        Route::get('/pdf-funcionarios-mais-emprestimos',    ['as'=>'funcionario.emprestimo.pdf',    'uses'=>'RelatorioController@gerarPDFFuncionariosComMaisEmprestimos']);
        Route::get('/baixar-funcionarios-mais-emprestimos', ['as'=>'funcionario.emprestimo.baixar', 'uses'=>'RelatorioController@baixarPDFFuncionariosComMaisEmprestimos']);

    });
});

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@loginCustom');
Route::get('logout', 'Auth\AuthController@logout');

// API Gráficos
Route::group(['prefix' => 'chart'], function(){

    Route::get('/sumarizacao', ['as'=>'chart.sumarizacao', 'uses'=>'ApiGraphController@sumarizarLogs']);

    Route::get('/emprestimos-atrasados', ['as'=>'emprestimo.atrasado', 'uses'=>'ApiGraphController@emprestimosAtrasados']);

});