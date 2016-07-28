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
        'telefone' => $faker->phoneNumber,
        'telefone2' => $faker->phoneNumber,
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
        'num_registro' => $faker->unique()->bankAccountNumber,
        'tipo_funcionario' => random_int(0, 2),
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
| Factory de Livros
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\DataShow::class, function (Faker\Generator $faker) {
    return [
        'marca' => $faker->companySuffix,
        'codigo' => $faker->unique()->randomNumber(7),
    ];
});