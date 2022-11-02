@extends('administracao.template')
@section('titulo', isset($endereco) ? 'ATUALIZAR ENDEREÇO' :'CADASTRAR ENDERECO')
@php
    $migalhas = [
        ['item' => 'ENDEREÇOS', 'link' => route('endereco.index')],
        ['item' => isset($endereco) ? 'ATUALIZAR ENDEREÇO' : 'CADASTRAR ENDERECO', 'link' => '#']
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="block block-rounded">
                    <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link {{ isset($_GET['instituicoes']) ? '' : 'active' }}"
                                    id="btabs-animated-slideleft-dados-tab" data-bs-toggle="tab"
                                    data-bs-target="#btabs-animated-slideleft-dados" role="tab"
                                    aria-controls="btabs-animated-slideleft-dados" aria-selected="true">Dados
                            </button>
                        </li>
                        @if(isset($endereco))
                            <li class="nav-item">
                                <button class="nav-link {{ isset($_GET['instituicoes']) ? 'active' : '' }}"
                                        id="btabs-animated-slideleft-instituicoes-tab" data-bs-toggle="tab"
                                        data-bs-target="#btabs-animated-slideleft-instituicoes" role="tab"
                                        aria-controls="btabs-animated-slideleft-instituicoes" aria-selected="false">
                                    Instituições
                                </button>
                            </li>
                        @endif
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left {{ isset($_GET['instituicoes']) ? '' : 'show active' }}"
                             id="btabs-animated-slideleft-dados"
                             role="tabpanel" aria-labelledby="btabs-animated-slideleft-dados-tab">
                            <form method="POST"
                                  action="{{ isset($endereco) ? route('endereco.update', $endereco->id) : route('endereco.store', $instituicao ?? '') }}"
                                  enctype="application/x-www-form-urlencoded">
                                @csrf
                                @if(isset($endereco))
                                    @method('PUT')
                                @endif
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label" for="cep">CEP</label>
                                        <input type="tel" class="form-control" id="cep" name="cep"
                                               value="{{isset($endereco) ? $endereco->cep : $cep}}" required
                                               placeholder="00000-000" autofocus>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3 col-xs-12 mb-4">
                                        <label class="form-label" for="tipo_logradouro">Tipo</label>
                                        <select class="js-select2 form-select" id="tipo_logradouro"
                                                name="tipo_logradouro"
                                                style="width: 100%;" data-placeholder="Selecione...">
                                            <option value=""></option>
                                            @foreach($tiposLogradouros as $tipoLogradouro)
                                                <option
                                                    value="{{$tipoLogradouro}}" {{ isset($endereco) && $endereco->tipo_logradouro == $tipoLogradouro ? 'selected' : '' }}>{{$tipoLogradouro}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <label class="form-label" for="logradouro">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro"
                                               required
                                               placeholder="Logradouro"
                                               value="{{isset($endereco) ? $endereco->logradouro : ''}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-xs-12 mb-4">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro"
                                               value="{{isset($endereco) ? $endereco->bairro : ''}}"
                                               placeholder="Bairro">
                                    </div>
                                    <div class="col-md-5 col-xs-12 mb-4">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade"
                                               value="{{isset($endereco) ? $endereco->cidade : ''}}"
                                               placeholder="Cidade">
                                    </div>
                                    <div class="col-md-2 col-xs-12 mb-4">
                                        <label for="uf" class="form-label">UF</label>
                                        <input type="text" class="form-control" id="uf" name="uf"
                                               value="{{isset($endereco) ? $endereco->uf : ''}}" placeholder="UF">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-lg btn-success">
                                            <i class="far fa fa-save me-1"></i>Salvar
                                        </button>
                                        <a href="{{route('endereco.index')}}"
                                           class="btn btn-lg btn-outline-info">Voltar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if(isset($endereco))
                            <div class="tab-pane fade fade-left {{ isset($_GET['instituicoes']) ? 'show active' : '' }}"
                                 id="btabs-animated-slideleft-instituicoes" role="tabpanel"
                                 aria-labelledby="btabs-animated-slideleft-instituicoes-tab">
                                <table class="table table-vcenter table-striped table-hover">
                                    <thead>
                                    <tr class="bg-body-dark">
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th style="width: 70%">Nomeclatura</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Capacidade
                                        </th>
                                        <th class="text-center" style="width: 15%">Registrada em</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($instituicoes as $instituicao)
                                        <tr>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('instituicao.edit', $instituicao->id) }}"
                                                       class="btn btn-sm btn-alt-secondary"
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
                                        <td colspan="4">{{ $instituicoes->appends(['instituicoes' => true])->links() }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade fade-left"
                                 id="btabs-animated-slideleft-colaboradores" role="tabpanel">
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
