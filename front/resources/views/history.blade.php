@extends('menu')
@section('conteudo')
    <div class="container" style="margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase mb-0">Histórico de busca</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap user-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Titulo do vídeo</th>
                                        <th scope="col" class="border-0 text-uppercase font-medium">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data ?? '' as $history)
                                        <tr>
                                            <td class="pl-4">{{$history['id']}}</td>
                                            <td>
                                                <h5 class="font-medium mb-0"> {{ $history['title'] }}</h5>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ date('d/m/Y', strtotime($history['date'])); }} 
                                                </span><br>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
