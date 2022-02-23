@extends('header')
@section('conteudo')
    <ul class="nav justify-content-end">
        <span>
            @if($user ?? '')
            <li class="nav-item">
                <a class="nav-link disabled" >Olá {{$user ?? ''}}</a>
            </li>
            @endif
        </span>
        @if($type == 1 ?? '')
            <li class="nav-item">
                <a class="nav-link active" href="/register">Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Edição</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="#">Buscar Vídeos</a>
        </li>
    </ul>
@stop
