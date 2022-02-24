@extends('menu')
@section('conteudo')
    <div class="container" style="margin-top:20px; ">
        <div class="card" style="padding: 20px;">
            <h4>Busca de vídeos no Youtube</h4>
            <div class="container">
                <form method="post" action={{ route('search-api') }}>
                    @csrf
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleInputTitle">Digite o titulo do vídeo</label>
                                <input type="text" class="form-control" required name="title" id="exampleInputTitle">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleMaxResults">Quantidade de resultados</label>
                                <input type="number" class="form-control" required name="maxResults"
                                    id="exampleMaxResults">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
            @if ($msg ?? '')
                <span>{{ $msg }}</span>
            @endif
            @if ($data ?? '')
                <hr />
                <h2>Total de vídeos encontrados {{ count($data) }}</h2>

                <div class="container">
                    <div class="row videos">
                        @foreach ($data as $video)
                            <div class="col-sm">
                                <span>{{ $video['snippet']['title'] }}</span><br />
                                <iframe width="450" height="215"
                                    src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
    </div>
    </div>
@stop
