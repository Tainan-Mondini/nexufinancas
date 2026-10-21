<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutenticacaoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_visitante_visualiza_as_telas_de_entrada_e_cadastro(): void
    {
        $this->get('/')->assertRedirect(route('login'));
        $this->get(route('login'))->assertOk()->assertSee('Entre na sua conta');
        $this->get(route('cadastro'))->assertOk()->assertSee('Crie sua conta');
    }

    public function test_usuario_pode_se_cadastrar_e_entrar(): void
    {
        $response = $this->post(route('cadastro.armazenar'), [
            'name' => 'Ana Silva',
            'email' => 'ANA@EXEMPLO.COM',
            'password' => 'senhasegura123',
            'password_confirmation' => 'senhasegura123',
        ]);

        $user = User::where('email', 'ana@exemplo.com')->firstOrFail();

        $response->assertRedirect(route('painel'));
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('users', ['email' => 'ana@exemplo.com']);
        $this->assertTrue(password_verify('senhasegura123', $user->password));
        $this->get(route('painel'))->assertOk()->assertSee('Ana Silva');
    }

    public function test_cadastro_exige_email_unico_e_senha_confirmada(): void
    {
        User::factory()->create(['email' => 'ana@exemplo.com']);

        $this->from(route('cadastro'))->post(route('cadastro.armazenar'), [
            'name' => 'Ana Silva',
            'email' => 'ANA@EXEMPLO.COM',
            'password' => 'short',
            'password_confirmation' => 'different',
        ])->assertRedirect(route('cadastro'))
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function test_usuario_pode_entrar_e_sair(): void
    {
        $user = User::factory()->create(['password' => 'senha12345']);

        $this->post(route('entrar.autenticar'), [
            'email' => strtoupper($user->email),
            'password' => 'senha12345',
            'remember' => '1',
        ])->assertRedirect(route('painel'));

        $this->assertAuthenticatedAs($user);

        $this->post(route('sair'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_credenciais_invalidas_sao_rejeitadas(): void
    {
        $this->post(route('entrar.autenticar'), [
            'email' => 'naoexiste@exemplo.com',
            'password' => 'senha-incorreta',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_painel_exige_autenticacao(): void
    {
        $this->get(route('painel'))->assertRedirect(route('login'));
    }
}
