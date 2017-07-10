<?php
/*
|--------------------------------------------------------------------------
| Factory de Editoras
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Editora::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Autores
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Autor::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'sobrenome' => $faker->lastName,
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Publicacões
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Publicacao::class, function (Faker\Generator $faker) {
    return [
        'descricao' => $faker->paragraph(1),
        'titulo' => $faker->sentence(3),
        'edicao' => str_random(4),
        'origem' => str_random(6),
        'codigo' => $faker->unique()->sentence(1),
        'status' => 1,
        'editora_id' => factory(\App\Models\Editora::class)->create()->id
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Livros
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Livro::class, function (Faker\Generator $faker) {
    return [
        'subtitulo' => $faker->name,
        'isbn' => $faker->randomNumber(5),
        'cdd' => $faker->randomNumber(3),
        'cdu' => $faker->randomNumber(3),
        'ano' => $faker->year,
        'autor_id' => factory(\App\Models\Autor::class)->create()->id
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Revistas
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Revista::class, function (Faker\Generator $faker) {
    return [
        'referencia' => $faker->date('m/Y'),
        'categoria' => $faker->sentence(1),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Pessoas/Usuários
|--------------------------------------------------------------------------
*/
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'nome' => $faker->name,
        'telefone' => $faker->randomNumber(8),
        'telefone2' => $faker->randomNumber(8),
        'email' => $faker->safeEmail,
        'remember_token' => str_random(10),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Funcionários
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Funcionario::class, function (Faker\Generator $faker) {
    return [
        'num_registro' => $faker->unique()->randomNumber(6),
        'tipo_funcionario' => random_int(0, 2),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Alunos
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Aluno::class, function (Faker\Generator $faker) {
    return [
        'matricula' => $faker->unique()->randomNumber(6),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Recursos
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Recurso::class, function (Faker\Generator $faker) {
    return [
        'descricao' => $faker->paragraph(1),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Data Shows
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\DataShow::class, function (Faker\Generator $faker) {
    return [
        'marca' => $faker->companySuffix,
        'codigo' => $faker->unique()->randomNumber(7),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Mapas
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Mapa::class, function (Faker\Generator $faker) {
    return [
        'numero' => $faker->numberBetween(10, 60),
        'titulo' => $faker->title,
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Salas
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Sala::class, function (Faker\Generator $faker) {
    return [
        'tipo' => $faker->numberBetween(0, 3),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Reserva de Recurso
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\ReservaRecurso::class, function (Faker\Generator $faker) {
    return [
        'data_reserva' => $faker->numberBetween(0, 3),
        'aula' => $faker->numberBetween(0, 3),
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Empréstimos
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Emprestimo::class, function (Faker\Generator $faker) {
    return [
        'data_devolucao' => null,
        'data_prevista' => $faker->dateTime,
        'data_emprestimo' => $faker->dateTime,
        'situacao' => 0,
        'user_id' => factory(\App\User::class)->create()->id
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Reservas
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Reserva::class, function (Faker\Generator $faker) {
    return [
        'data_devolucao' => null,
        'data_prevista' => $faker->dateTime,
        'data_emprestimo' => $faker->dateTime,
        'situacao' => 0,
        'user_id' => factory(\App\User::class)->create()->id
    ];
});