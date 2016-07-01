<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditoraTest extends TestCase
{

    public function test_criar_editora()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
}
