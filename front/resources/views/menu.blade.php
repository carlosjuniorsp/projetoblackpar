@extends('header')
@section('menu')
    <ul class="nav justify-content-end">
        <span>
            @if (Session::has('user'))
                <li class="nav-item">
                    <a class="nav-link disabled">Olá {{ Session::get('user') }}</a>
                </li>
            @endif
        </span>
        <li class="nav-item">
            <a class="nav-link active" href="/list-user">Home</a>
        </li>
        @if (Session::has('type') && Session::get('type') == 0)
            <li class="nav-item">
                <a class="nav-link active" href="/register">Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/list-user">Gerenciamento</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="#">Buscar Vídeos</a>
        </li>
    </ul>
@stop
