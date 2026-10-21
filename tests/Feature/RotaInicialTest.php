<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RotaInicialTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_a_rota_inicial_encaminha_para_entrada(): void
    {
        $this->get('/')->assertRedirect(route('login'));
    }
}
