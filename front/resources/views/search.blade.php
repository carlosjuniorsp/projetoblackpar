@extends('menu')
@section('conteudo')
    <div class="container" style="margin-top:20px; ">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 20px;">
                        <h4>Busca de vídeo no Youtube</h4>
                        <form method="post" action={{ route('register') }}>
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName">Digite o nome do vídeo</label>
                                <input type="text" class="form-control" required name="name" id="exampleInputName">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@stop
