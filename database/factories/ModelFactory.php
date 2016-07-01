<?php
/*
|--------------------------------------------------------------------------
| Factory de Usuários
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

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
        'descricao' => $faker->paragraph(2),
        'titulo' => $faker->unique()->title,
        'edicao' => str_random(4),
        'origem' => str_random(6),
        'editora' => factory(\App\Models\Editora::class)->create()->id
    ];
});

/*
|--------------------------------------------------------------------------
| Factory de Livros
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Livro::class, function (Faker\Generator $faker) {
    return [
        'subtitulo' => $faker->unique()->name,
        'isbn' => $faker->randomNumber(5),
        'cdd' => $faker->randomNumber(3),
        'cdu' => $faker->randomNumber(3),
        'ano' => $faker->year,
        'autor' => factory(\App\Models\Autor::class)->create()->id
    ];
});