@extends('header')
@section('conteudo')
    <div class="container-sm col-md-4">
        <h3>Tela de login</h3>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Endereço de email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    placeholder="Seu email">
                <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com
                    ninguém.</small>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Clique em mim</label>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <br /><br />
            @if ($msg ?? '')
                <div class="alert alert-primary" role="alert">
                    {{ $msg ?? '' }}
                </div>
            @endif
        </form>
    </div>
@stop
