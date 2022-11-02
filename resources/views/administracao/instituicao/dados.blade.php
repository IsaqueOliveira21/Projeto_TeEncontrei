@extends('administracao.template')
@section('titulo', isset($instituicao) ? 'ATUALIZAR INSTITUIÇÃO' : 'CADASTRAR INSTITUIÇÃO')
@php
    $migalhas = [
        ['item' => 'INSTITUIÇÕES', 'link' => route('instituicao.index')],
        ['item' => isset($instituicao) ? 'ATUALIZAR INSTITUIÇÃO' : 'CADASTRAR INSTITUIÇÃO', 'link' => '#'],
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
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
                        <li class="nav-item">
                            <button class="nav-link"
                                    id="btabs-animated-slideleft-colaboradores-tab" data-bs-toggle="tab"
                                    data-bs-target="#btabs-animated-slideleft-colaboradores" role="tab"
                                    aria-controls="btabs-animated-slideleft-colaboradores" aria-selected="false">
                                Colaboradores
                            </button>
                        </li>
                    @endif
                </ul>

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
                              action="{{isset($instituicao) ? route('instituicao.update', $instituicao->id) : route('instituicao.store')}}"
                              enctype="application/x-www-form-urlencoded">
                            @csrf
                            @if(isset($instituicao))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <input type="hidden" name="endereco_id" value="{{$endereco->id}}">
                                    <label class="form-label" for="nomeclatura">Nomeclatura</label>
                                    <input type="text" class="form-control" id="nomeclatura" name="nomeclatura"
                                           value="{{ isset($instituicao) ? $instituicao->nomeclatura : '' }}"
                                           required
                                           placeholder="Nomeclatura" autofocus>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-xs-12 mb-4">
                                    <label class="form-label" for="capacidade">Capacidade</label>
                                    <input type="number" class="form-control" id="capacidade" name="capacidade"
                                           value="{{ isset($instituicao) ? $instituicao->capacidade : '' }}"
                                           required
                                           placeholder="Capacidade">
                                </div>
                                <div class="col-md-2 col-xs-12 mb-4">
                                    <label class="form-label" for="cep">CEP</label>
                                    <input type="tel" class="form-control" id="cep" name="cep" readonly
                                           value="{{$endereco->cep}}"
                                           required
                                           placeholder="00000-000">
                                </div>
                                <div class="col-md-2 col-xs-12 mb-4">
                                    <label class="form-label" for="tipo_logradouro">Tipo</label>
                                    <input type="text" class="form-control" id="tipo_logradouro" name="tipo_logradouro"
                                           readonly
                                           value="{{$endereco->tipo_logradouro}}">
                                </div>
                                <div class="col-md-4 col-xs-12 mb-4">
                                    <label class="form-label" for="logradouro">Logradouro</label>
                                    <input type="text" class="form-control" id="logradouro" name="logradouro" readonly
                                           value="{{$endereco->logradouro}}">
                                </div>
                                <div class="col-md-2 col-xs-12 mb-4">
                                    <label class="form-label" for="numero_endereco">Nº</label>
                                    <input type="text" class="form-control" id="numero_endereco" name="numero_endereco"
                                           value="{{ isset($instituicao) ? $instituicao->numero_endereco : '' }}"
                                           placeholder="Numero">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12 mb-4">
                                    <label class="form-label" for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" readonly
                                           value="{{$endereco->bairro}}">
                                </div>
                                <div class="col-md-5 col-xs-12 mb-4">
                                    <label class="form-label" for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" readonly
                                           value="{{$endereco->cidade}}">
                                </div>
                                <div class="col-md-2 col-xs-12 mb-4">
                                    <label class="form-label" for="uf">UF</label>
                                    <input type="text" class="form-control" id="uf" name="uf" readonly
                                           value="{{$endereco->uf}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <button type="submit" class="btn btn-lg btn-success">
                                        <i class="far fa fa-save me-1"></i>Salvar
                                    </button>
                                    @if(isset($instituicao))
                                        <a href="{{ route('instituicao.buscarEndereco', $instituicao->id) }}"
                                           class="btn btn-lg btn-secondary">
                                            <i class="far fa fa-address-book me-1"></i>Alterar Endereço
                                        </a>
                                    @endif
                                    <a href="{{route('instituicao.index')}}"
                                       class="btn btn-lg btn-outline-info">Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
