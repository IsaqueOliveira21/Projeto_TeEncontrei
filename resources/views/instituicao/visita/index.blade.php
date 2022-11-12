@extends('instituicao.template')

@section('titulo', 'VISITAS')

@php
    $migalhas = [
        ['item' => 'VISITAS', 'link' => '#']
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <form class="row row-cols-lg-auto g-3 align-items-center mb-4" method="get" action="{{ route('visita.index') }}" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <input type="hidden" name="pesquisa" value="true">
                    <div class="col-sm-6 col-xs-12">
                        <input type="text" style="width: 400px" class="js-flatpickr form-control" id="example-flatpickr-range" name="datas" value="{{ $_GET['datas'] ?? '' }}" placeholder="Selecione o período de datas" data-mode="range">
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <select style="width: 300px" class="js-select2 form-select" id="example-select2" name="desabrigado_id" data-placeholder="Desabrigado...">
                            <option></option>
                            @foreach($desabrigados as $desabrigado)
                                <option value="{{$desabrigado->id}}" {{ isset($_GET['desabrigado_id']) && $_GET['desabrigado_id'] == $desabrigado->id ? 'selected' : '' }}>{{ "{$desabrigado->nome} {$desabrigado->sobrenome}" }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-search me-1"></i> Pesquisar
                        </button>
                        <a href="{{ route('visita.index') }}" class="btn btn-alt-secondary">Resetar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="block-content">
                    <table class="table table-vcenter table-striped table-hover">
                        <thead>
                        <tr class="bg-body-dark">
                            <th class="text-center" style="width: 15%;">#</th>
                            <th style="width: 65%">Desabrigado</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Registrado em</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($visitas as $visita)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('visita.edit', $visita->id) }}"
                                           class="btn btn-sm btn-alt-secondary"
                                           data-bs-toggle="tooltip"
                                           title="Editar">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('visita.delete', $visita->id) }}"
                                           class="btn btn-sm btn-alt-danger"
                                           data-bs-toggle="tooltip"
                                           title="Deletar">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                                <td class="fw-semibold">{{ $visita->desabrigado->nome }}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($visita->created_at)->format('d/m/Y H:i:s')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Sem registros para exibir</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{{ $visitas->appends($_GET)->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
