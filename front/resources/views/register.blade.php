@extends('menu')
@section('conteudo')
    <div class="container" style="margin-top:20px">
        <h4>Cadastro de usuário</h4>
        <form method="post" action={{ route('register') }}>
            @csrf
            <div class="form-group">
                <label for="exampleInputNamed">Nome</label>
                <input type="Named" class="form-control" required name="name" id="exampleInputNamed">
            </div>
            <div class="form-group">
                <label for="exampleInputLastName">Sobre Nome</label>
                <input type="LastName" class="form-control" required name="last_name" id="exampleInputLastName">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input type="email" class="form-control" required name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Senha</label>
                <input type="password" class="form-control" required name="password" id="exampleInputPassword">
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Telefone</label>
                <input type="phone" maxlength="11" class="form-control" required name="phone" id="exampleInputPhone">
            </div>
            <div class="form-group">
                <label for="exampleInputType">Admin</label>
                <select class="form-control" required name="type">
                    <option value="0">Sim</option>
                    <option value="1">Não</option>
                </select>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Salvar</button>
            <br /><br />
            @if ($msg ?? '')
                <div class="alert alert-primary" role="alert">
                    {{ $msg ?? '' }}
                </div>
            @endif
        </form>
    </div>
@stop
