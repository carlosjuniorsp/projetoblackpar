@extends('menu')
@section('conteudo')
    <div class="container" style="margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::get('type') == 0)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0">Gerenciamento de usuários</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap user-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Nome</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Sobre nome</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Telefone</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Categoria</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($msg as $data)
                                            <tr>
                                                <td class="pl-4">1</td>
                                                <td>
                                                    <h5 class="font-medium mb-0"> {{ $data['name'] }}</h5>
                                                </td>
                                                <td>
                                                    <span class="text-muted"> {{ $data['last_name'] }}</span><br>
                                                </td>
                                                <td>
                                                    <span class="text-muted"> {{ $data['phone'] }}</span><br>
                                                </td>
                                                <td>
                                                    <span class="text-muted"> {{ $data['email'] }}</span><br>
                                                </td>
                                                <td>
                                                    <span class="text-muted">
                                                        {{ $data['type'] == 0 ? 'Administrador' : 'Usuário' }}</span><br>
                                                </td>
                                                <td>
                                                    <a href="{{ route('delete', ['id' => $data['id']]) }}"
                                                        class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i
                                                            class="fa fa-trash" title="Deletar"></i> </a>
                                                    <a href="{{ route('list', ['id' => $data['id'] ?? '']) }}"
                                                        class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i
                                                            class="fa fa-edit" title="Editar"></i> </a>
                                                    <a href="#"
                                                        class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"
                                                        title="Ver histórico" data-original-title="view"><i
                                                            class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <h2>Esta é sua página inicial</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
