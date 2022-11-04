@extends('instituicao.template')

@section('titulo', 'COLABORADORES')

@php
    $migalhas = [
        ['item' => 'COLABORADORES', 'link' => '#']
];
@endphp

@section('conteudo')
    <form method="get" action="{{route('colaborador.index')}}" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control form-control-alt" id="pesquisa"
                               name="pesquisa" value="{{$_GET['pesquisa'] ?? ''}}"
                               placeholder="Pesquisar colaborador..." autofocus>
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
                            <th style="width: 60%">Nome</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Cargo</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Status</th>
                            <th class="text-center" style="width: 15%">Registrada em</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($colaboradores as $colaborador)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip"
                                                title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <a href="{{ route('colaborador.edit', $colaborador->id) }}" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip"
                                                title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                                {{--<td class="fw-semibold">{{"{$colaborador->user->name} {$colaborador->user->last_name}"}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$colaborador->cargo}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$colaborador->ativo == 1 ? 'Ativo' : 'Inativo'}}</td>
                                <td class="text-center">{{$colaborador->created_at->format('d/m/Y H:i:s')}}</td>--}}

                                <td class="fw-semibold">{{"{$colaborador->name} {$colaborador->last_name}"}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$colaborador->cargo}}</td>
                                <td class="d-none d-sm-table-cell text-center">{{$colaborador->ativo == 1 ? 'Ativo' : 'Inativo'}}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($colaborador->created_at)->format('d/m/Y H:i:s')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">Sem registros para exibir</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{{ $colaboradores->appends($_GET)->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
