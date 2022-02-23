@extends('menu')
@section('conteudo')
    <div class="container" style="margin-top:20px">
        <h4>Edição do usuário de usuário</h4>
        <form method="post" action={{ route('edit', ['id' => $users['id']]) }}>
            @csrf
            <div class="form-group">
                <label for="exampleInputNamed">Nome</label>
                <input type="Named" class="form-control" required name="name" value="{{ $users['name'] }}"
                    id="exampleInputNamed">
            </div>
            <div class="form-group">
                <label for="exampleInputLastName">Sobre Nome</label>
                <input type="LastName" class="form-control" required name="last_name" value="{{ $users['last_name'] }}"
                    id="exampleInputLastName">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input type="email" disabled class="form-control" required name="email" value="{{ $users['email'] }}"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Senha</label>
                <input type="password" disabled class="form-control" required name="password"
                    value="{{ $users['password'] }}" id="exampleInputPassword">
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Telefone</label>
                <input type="phone" maxlength="11" class="form-control" required name="phone"
                    value="{{ $users['phone'] }}" id="exampleInputPhone">
            </div>
            <div class="form-group">
                <label for="exampleInputType">Categoria</label>
                <select class="form-control" required name="type" value="{{ $users['type'] }}" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="0">Admin</option>
                    <option value="1">Usuário</option>
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
