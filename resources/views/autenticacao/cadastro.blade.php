@extends('layouts.principal')

@section('title', 'Criar conta')

@section('content')
<main class="estrutura-autenticacao">
    <aside class="painel-lateral">
        <div class="lateral-topo">
            @include('partials.marca')
            <span class="lateral-etiqueta">FINANÇAS MAIS LEVES</span>
        </div>

        <div class="lateral-conteudo">
            <span class="rotulo"><span class="ponto-rotulo"></span> UM NOVO COMEÇO</span>
            <h1>Seu dinheiro<br><span>no mesmo time.</span></h1>
            <p>Organize suas finanças com clareza e construa planos junto com quem caminha ao seu lado.</p>
        </div>

        <div class="cartao-citacao">
            <span class="aspas-citacao" aria-hidden="true">“</span>
            <blockquote>Quando a conversa sobre dinheiro fica leve, os planos ficam mais perto.</blockquote>
            <div class="legenda-citacao"><span></span> Um passo de cada vez</div>
        </div>

        <div class="lateral-rodape">
            <span>Feito para a vida real.</span>
            <span>01 — 03</span>
        </div>
    </aside>

    <section class="area-autenticacao">
        <div class="marca-movel">@include('partials.marca')</div>
        <div class="conteudo-autenticacao conteudo-cadastro">
            <div class="cabecalho-autenticacao">
                <span class="rotulo rotulo-autenticacao">COMECE POR VOCÊ</span>
                <h2>Crie sua conta</h2>
                <p>É rápido. E o primeiro passo para organizar seus planos.</p>
            </div>

            <form class="formulario-autenticacao" method="POST" action="{{ route('cadastro.armazenar') }}">
                @csrf

                <div class="campo">
                    <label for="name">Como podemos te chamar?</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name"
                        placeholder="Seu nome" required autofocus
                        @class(['campo-com-erro' => $errors->has('name')])>
                    @error('name')
                        <p class="erro-campo" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="campo">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
                        placeholder="voce@exemplo.com" required
                        @class(['campo-com-erro' => $errors->has('email')])>
                    @error('email')
                        <p class="erro-campo" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password">Crie uma senha</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        placeholder="Pelo menos 8 caracteres" required
                        @class(['campo-com-erro' => $errors->has('password')])>
                    @error('password')
                        <p class="erro-campo" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password_confirmation">Confirme sua senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" placeholder="Digite a senha novamente" required>
                </div>

                <button class="botao-principal" type="submit">
                    Criar minha conta <span aria-hidden="true">→</span>
                </button>
                <p class="nota-formulario">Seus dados são protegidos e usados apenas para manter sua conta.</p>
            </form>

            <p class="alternar-autenticacao">Já tem uma conta? <a href="{{ route('login') }}">Entrar</a></p>
        </div>
        <footer class="rodape-movel">Feito para a vida real.</footer>
    </section>
</main>
@endsection
