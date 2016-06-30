<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PublicacaoTest extends TestCase
{

    public function test_criar_publicacao()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
}
