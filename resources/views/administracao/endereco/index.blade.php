@extends('administracao.template')

@section('titulo', 'LISTA DE ENDEREÇOS')

@php
    $migalhas = [
        ['item' => 'ENDEREÇOS', 'link' => '#']
];
@endphp

@section('conteudo')
    <form method="get" action="{{route('endereco.index')}}" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control form-control-alt" id="pesquisa"
                               name="pesquisa" value="{{$_GET['pesquisa'] ?? ''}}"
                               placeholder="Pesquisar Endereço..." autofocus>
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-search me-1"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="block-content">
                    <table class="table table-vcenter table-striped table-hover">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="text-center" style="width: auto;">#</th>
                            <th style="width: auto">CEP</th>
                            <th class="text-left" style="width: auto">Logradouro</th>
                            <th class="text-left" style="width: auto">Bairro</th>
                            <th class="text-left" style="width: auto">Cidade</th>
                            <th class="text-center" style="width: auto">UF</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($enderecos as $endereco)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" onclick="deletarEndereco({{$endereco->id}})">
                                            <div class="btn btn-sm btn-alt-secondary">
                                                <i class="far fa-fw fa-trash-alt"></i>
                                            </div>
                                        </a>
                                        <a href="{{route('endereco.edit', $endereco->id)}}" class="btn btn-sm btn-alt-secondary"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="fw-semibold text-left">{{$endereco->cep}}</td>
                                <td class="d-none d-sm-table-cell text-left">{{$endereco->tipo_logradouro.' '.$endereco->logradouro}}</td>
                                <td class="d-none d-sm-table-cell text-left">{{$endereco->bairro}}</td>
                                <td class="d-none d-sm-table-cell text-left">{{$endereco->cidade}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$endereco->uf}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">Sem endereços para exibir</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6">{{ $enderecos->appends($_GET)->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletarEndereco(id) {
            if (confirm('Deseja realmente remover este endereço?')) {
                window.location.href = '{{route('endereco.delete')}}?id=' + id;
            }
        }
    </script>
@endsection
