@extends('menu')
@section('conteudo')
    @if (!Session::has('user'))
        {{ Redirect::to('/') }}
    @else
        <div class="container">
            <h1>Página inicial</h1>
        </div>
    @endif
@stop
