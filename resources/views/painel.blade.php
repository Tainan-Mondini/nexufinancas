@extends('layouts.principal')

@section('title', 'Início')

@section('content')
<main class="estrutura-painel">
    <header class="cabecalho-painel">
        @include('partials.marca')
        <form method="POST" action="{{ route('sair') }}">
            @csrf
            <button class="botao-sair" type="submit">Sair da conta <span aria-hidden="true">↗</span></button>
        </form>
    </header>

    <section class="boas-vindas-painel">
        <span class="rotulo rotulo-autenticacao">SEU ESPAÇO FINANCEIRO</span>
        <h1>Boas-vindas, {{ auth()->user()->name }}.</h1>
        <p>Sua conta está pronta. Estamos construindo seu espaço para organizar receitas, despesas e planos compartilhados.</p>
        <div class="proximo-painel">
            <span class="icone-proximo" aria-hidden="true">✳</span>
            <div>
                <strong>O próximo passo começa aqui</strong>
                <p>Vamos preparar seu primeiro painel financeiro.</p>
            </div>
        </div>
    </section>
</main>
@endsection
