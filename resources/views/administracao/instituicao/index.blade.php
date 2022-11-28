@extends('administracao.template')

@section('titulo', 'INSTITUIÇÕES')

@php
    $migalhas = [
        ['item' => 'INSTITUIÇÕES', 'link' => '#']
];
@endphp

@section('conteudo')
    <form method="get" action="{{route('instituicao.index')}}" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control form-control-alt" id="pesquisa"
                               name="pesquisa" value="{{$_GET['pesquisa'] ?? ''}}"
                               placeholder="Pesquisar instituição..." autofocus>
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
                            <th style="width: 70%">Nomeclatura</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Capacidade</th>
                            <th class="text-center" style="width: 15%">Registrada em</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($instituicoes as $instituicao)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#"
                                           class="btn btn-sm btn-alt-danger"
                                           data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="{{$instituicao->id}}"
                                           data-item="{{$instituicao->nomeclatura}}"
                                           data-url="delete/instituicao"
                                           title="Deletar">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{ route('instituicao.edit', $instituicao->id) }}" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip"
                                                title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{$instituicao->nomeclatura}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$instituicao->capacidade}}</td>
                                <td class="text-center">{{$instituicao->created_at->format('d/m/Y H:i:s')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">Sem registros para exibir</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{{ $instituicoes->appends($_GET)->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
