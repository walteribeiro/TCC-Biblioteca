<?php

use App\Models\Aluno;
use App\User;
use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Turma 1A
        factory(User::class, 1)->create(['nome' => 'AGATHA ARAÚJO PINTO'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '130218']));
        });
        factory(User::class, 1)->create(['nome' => 'ANA CAROLINA MELQUIADES CAMILO'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '170283']));
        });
        factory(User::class, 1)->create(['nome' => 'ANA GABRIELY FERREIRA PAULINO'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '120114']));
        });
        factory(User::class, 1)->create(['nome' => 'ANDERSON FARIA MOREIRA'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '150217']));
        });
        factory(User::class, 1)->create(['nome' => 'ANNA BEATRIZ EITERER NASCIMENTO'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '130226']));
        });
        factory(User::class, 1)->create(['nome' => 'BERNARDO MULLER RODRIGUES'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '170019']));
        });
        factory(User::class, 1)->create(['nome' => 'BRUNA OLIVEIRA FREDERICO'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '101440']));
        });
        factory(User::class, 1)->create(['nome' => 'DANIEL DE SÁ'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '150045']));
        });
        factory(User::class, 1)->create(['nome' => 'DÉBORA BERNARDO BARBOZA'])->each(function($u){
        $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '170036']));
        });
        factory(User::class, 1)->create(['nome' => 'GABRIEL REZENDE TAVARES'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '110236']));
        });
        factory(User::class, 1)->create(['nome' => 'GIANCARLO GONÇALVES AZEVEDO'])->each(function($u){
            $u->aluno()->save(factory(Aluno::class)->make(['matricula' => '170014']));
        });

//GIULIA GONÇALVES JULIÃO
//GUSTAVO HENRIQUE BALDUTTI DA SILVA
//HIGOR OLIVEIRA KELMER
//JOÃO GABRIEL PIMENTEL DE SOUZA
//JOÃO PEDRO LAZARONI DOS SANTOS
//JOÃO PEDRO WAN DE POL LAWALL
//JOÃO VIANA DE LERY MENDES
//JORDANA GASPAR LIMA
//KAMILLY DE FARIA VIDAL COELHO
//LAURA CLAIRE GUEDES DE ASSIS
//LAURA JANUARIO THEODORO AFONSO
//LAURA MARIA BOTARO DE PAULA
//LEONARDO DE ALMEIDA DIAS DA SILVA
//LÍVIA ARAUJO PERON
//LUANDA FAGUNDES DIAS
//LUCAS ALMEIDA SILVA
//LUCAS DA SILVA MATEUS
//LUCAS ELIAS VIEIRA TORQUATO
//LUÍS GUSTAVO DE MATOS BOA MORTE
//MARIA LUIZA DALESSI
//MARINA DOS SANTOS TEODORO
//MARINA FIGUEIREDO GABRIEL
//NAARA HILARIO MAZZI
//NÚBIA ABREU RANGEL CÔGO
//THIAGO HENRIQUE TOSTES
//VINÍCIUS APEL DE OLIVEIRA
//VITÓRIA DE SOUZA CAVALCANTI
//YAN FONSECA FERNANDES DE PAULA
//YASMIN DE ALMEIDA JOSÉ

    }
}
