@extends('header')
@section('conteudo')
    <div class="container">
        <h4>Cadastro de usuário</h4>
        <form method="post" action={{ route('register') }}>
            @csrf
            <div class="form-group">
                <label for="exampleInputNamed">Nome</label>
                <input type="Named" class="form-control" name="name" id="exampleInputNamed">
            </div>
            <div class="form-group">
                <label for="exampleInputLastName">Sobre Nome</label>
                <input type="LastName" class="form-control" name="last_name" id="exampleInputLastName">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Senha</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword">
            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Telefone</label>
              <input type="phone" maxlength="11" class="form-control" name="phone" id="exampleInputPhone">
          </div>
            <div class="form-group">
                <label for="exampleInputType">Admin</label>
                <select class="form-control" name="type">
                    <option value="1">Sim</option>
                    <option value="2">Não</option>
                </select>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@stop
