@extends('instituicao.template')

@section('titulo', isset($visitaCabecalho) ? 'ATUALIZAR VISITA' :'CADASTRAR VISITA')

@php
    $migalhas = [
        ['item' => 'VISITAS', 'link' => route('visita.index')],
        ['item' => isset($visitaCabecalho) ? 'ATUALIZAR VISITA' : 'CADASTRAR VISITA', 'link' => '#'],
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="row">
            <div class="block block-rounded col-12">
                <div class="block-content">
                    <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active"
                                    id="btabs-animated-slideleft-dados-tab" data-bs-toggle="tab"
                                    data-bs-target="#btabs-animated-slideleft-dados" role="tab"
                                    aria-controls="btabs-animated-slideleft-dados" aria-selected="true">Dados
                            </button>
                        </li>
                    </ul>

                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left show active"
                             id="btabs-animated-slideleft-dados"
                             role="tabpanel" aria-labelledby="btabs-animated-slideleft-dados-tab">
                            <form method="POST"
                                  action="{{ isset($visitaCabecalho) ? route('visita.update', $visitaCabecalho->id) : route('visita.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @if(isset($visitaCabecalho))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        @if(isset($dadosDesabrigado) && !is_null($dadosDesabrigado))
                                            <input type="hidden" id="desabrigado_id" name="desabrigado_id" value="{{ $dadosDesabrigado[0] }}">
                                            <input type="text" class="form-control" value="{{ $dadosDesabrigado[1] }}" readonly>
                                        @else
                                            <label class="form-label" for="desabrigado_id">Desabrigado</label>
                                            <select class="js-select2 form-select" id="desabrigado_id"
                                                    name="desabrigado_id"
                                                    style="width: 100%;" data-placeholder="Selecione...">
                                                <option value=""></option>
                                                @foreach($desabrigados as $desabrigado)
                                                    <option
                                                        value="{{ $desabrigado->id }}" {{ isset($visitaCabecalho) && $desabrigado->id == $visitaCabecalho->desabrigado_id ? 'selected' : '' }}>{{"{$desabrigado->nome} {$desabrigado->sobrenome}"}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="tipo">Adicionar evento</label>
                                        <select class="js-select2 form-select" id="tipo"
                                                name="tipo"
                                                style="width: 100%;" {{!isset($visitaCabecalho) ? 'required' : ''}} data-placeholder="Selecione...">
                                            <option value=""></option>
                                            <option value="CHECK-IN">CHECK-IN</option>
                                            <option value="CHECK-OUT">CHECK-OUT</option>
                                        </select>
                                    </div>
                                    @if(isset($visitaCabecalho))
                                        <div class="row">
                                            <table class="table table-bordered table-responsive table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%" class="text-center">#</th>
                                                    <th style="width: 40%">Colaborador</th>
                                                    <th style="width: 25%">Tipo</th>
                                                    <th style="width: 25%">Data/Hora</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($visitaCabecalho->detalhes as $detalhe)
                                                    <tr>
                                                        <td class="text-center">
                                                                <a href="#" onclick="deletarDetalhe({{ $detalhe->id }})"
                                                                   class="btn btn-sm btn-alt-danger"
                                                                   data-bs-toggle="tooltip"
                                                                   title="Deletar">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                        </td>
                                                        <td>{{ "{$detalhe->colaborador->user->name} {$detalhe->colaborador->user->last_name}" }}</td>
                                                        <td>{{ $detalhe->tipo }}</td>
                                                        <td>{{ $detalhe->created_at->format('d/m/Y H:i:s') }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <button type="submit" class="btn btn-lg btn-success">
                                                <i class="far fa fa-save me-1"></i>Salvar
                                            </button>
                                            <a href="{{route('visita.create')}}"
                                               class="btn btn-lg btn-primary">
                                                <i class="fa fa-plus me-1"></i>Novo
                                            </a>
                                            <a href="{{route('visita.index')}}"
                                               class="btn btn-lg btn-outline-info">Voltar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletarDetalhe(id){
            if(confirm('Deseja realmente remover esse evento?')){
                window.location.href='{{ route('visita.detalhe.delete') }}?id=' + id;
            }
        }
    </script>
@endsection
