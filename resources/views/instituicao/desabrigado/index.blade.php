@extends('instituicao.template')

@section('titulo', 'LISTA DE DESABRIGADOS')

@php
    $migalhas = [
        ['item' => 'LISTA DE DESABRIGADOS', 'link' => '#']
];
@endphp

@section('conteudo')
    <form method="get" action="{{route('desabrigado.index')}}" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control form-control-alt" id="pesquisa"
                               name="pesquisa" value="{{$_GET['pesquisa'] ?? ''}}"
                               placeholder="Pesquisar desabrigado..." autofocus>
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
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 30%">Nome</th>
                            <th style="width: 30%">CPF</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">Cadastrado em</th>
                            <th class="text-center" style="width: 10%">Dados</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($desabrigados as $desabrigado)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-alt-danger"
                                           data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="{{$desabrigado->id}}"
                                           data-item="{{$desabrigado->nome.' '.$desabrigado->sobrenome}}"
                                           data-url="delete"
                                           role="button"
                                           title="Deletar">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{route('desabrigado.edit', $desabrigado->id)}}" class="btn btn-sm btn-alt-secondary"
                                           data-bs-toggle="tooltip"
                                           title="Editar">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{$desabrigado->nome.' '.$desabrigado->sobrenome}}</td>
                                <td class="fw-semibold">{{$desabrigado->cpf}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$desabrigado->created_at->format('d/m/Y H:i:s')}}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary" role="button">Dados</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Sem registros para exibir</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">{{ $desabrigados->appends($_GET)->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteDesabrigado(id) {
            if(confirm('Deseja realmente remover este desabrigado?')) {
                window.location.href = '{{route('desabrigado.delete')}}?id=' + id;
            }
        }
    </script>
@endsection
