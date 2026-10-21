@extends('layouts.principal')

@section('title', 'Entrar')

@section('content')
<main class="estrutura-autenticacao">
    <aside class="painel-lateral">
        <div class="lateral-topo">
            @include('partials.marca')
            <span class="lateral-etiqueta">FINANÇAS MAIS LEVES</span>
        </div>

        <div class="lateral-conteudo">
            <span class="rotulo"><span class="ponto-rotulo"></span> SUA VIDA, EM EQUILÍBRIO</span>
            <h1>Planos a dois.<br><span>Conquistas de verdade.</span></h1>
            <p>Um jeito mais simples de cuidar do seu dinheiro — sozinho ou junto com quem importa.</p>
        </div>

        <div class="cartao-previa" aria-label="Prévia ilustrativa do painel financeiro">
            <div class="cabecalho-previa">
                <div>
                    <span class="etiqueta-previa">VISÃO DO MÊS</span>
                    <strong>Seu dinheiro, com clareza</strong>
                </div>
                <span class="icone-previa" aria-hidden="true">↗</span>
            </div>
            <div class="grafico-previa" aria-hidden="true">
                <span style="height: 34%"></span><span style="height: 48%"></span><span style="height: 41%"></span>
                <span style="height: 62%"></span><span style="height: 52%"></span><span style="height: 76%"></span>
                <span style="height: 66%"></span><span class="destaque-grafico" style="height: 92%"></span>
                <span style="height: 71%"></span><span style="height: 82%"></span><span style="height: 61%"></span>
                <span style="height: 74%"></span>
            </div>
            <div class="rodape-previa">
                <span>Uma visão que aproxima</span>
                <span class="pilha-avatar" aria-hidden="true"><i>V</i><i>R</i></span>
            </div>
        </div>

        <div class="lateral-rodape">
            <span>Feito para a vida real.</span>
            <span>01 — 03</span>
        </div>
    </aside>

    <section class="area-autenticacao">
        <div class="marca-movel">@include('partials.marca')</div>
        <div class="conteudo-autenticacao">
            <div class="cabecalho-autenticacao">
                <span class="rotulo rotulo-autenticacao">BOM TER VOCÊ DE VOLTA</span>
                <h2>Entre na sua conta</h2>
                <p>Continue cuidando do que importa.</p>
            </div>

            @if (session('status'))
                <div class="mensagem-status" role="status">{{ session('status') }}</div>
            @endif

            <form class="formulario-autenticacao" method="POST" action="{{ route('entrar.autenticar') }}">
                @csrf

                <div class="campo">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
                        placeholder="voce@exemplo.com" required autofocus
                        @class(['campo-com-erro' => $errors->has('email')])>
                    @error('email')
                        <p class="erro-campo" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="campo">
                    <div class="linha-rotulo-campo">
                        <label for="password">Senha</label>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        placeholder="Sua senha" required
                        @class(['campo-com-erro' => $errors->has('password')])>
                    @error('password')
                        <p class="erro-campo" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <label class="linha-checkbox">
                    <input type="checkbox" name="remember" value="1">
                    <span class="caixa-checkbox" aria-hidden="true"></span>
                    <span>Manter conectado</span>
                </label>

                <button class="botao-principal" type="submit">
                    Entrar <span aria-hidden="true">→</span>
                </button>
            </form>

            <p class="alternar-autenticacao">Ainda não tem uma conta? <a href="{{ route('cadastro') }}">Criar conta</a></p>
            <p class="aviso-legal">Organização financeira, no seu ritmo.</p>
        </div>
        <footer class="rodape-movel">Feito para a vida real.</footer>
    </section>
</main>
@endsection
