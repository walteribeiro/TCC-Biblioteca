<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class TestEditora extends TestCase{

    use WithoutMiddleware;

    public function test_listagem_editoras()
    {
        $this->artisan('migrate');
        $this->visit('/editoras')
            ->see('Editoras');
    }
}