@extends('instituicao.template')

@section('titulo', isset($desabrigado) ? 'ATUALIZAR DESABRIGADO' : 'CADASTRAR DESABRIGADO')

@php
    $migalhas = [
        ['item' => 'DESABRIGADOS', 'link' => route('desabrigado.index')],
        ['item' => isset($desabrigado) ? 'ATUALIZAR DESABRIGADO' : 'CADASTRAR DESABRIGADO'],
];
@endphp

@section('conteudo')
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <div class="block block-rounded">
                    <div class="block-content">
                        <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active"
                                        id="btabs-animated-slideleft-dados-tab" data-bs-toggle="tab"
                                        data-bs-target="#btabs-animated-slideleft-dados" role="tab"
                                        aria-controls="btabs-animated-slideleft-dados" aria-selected="true">Dados
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link"
                                        id="btabs-animated-slideleft-visitas-tab" data-bs-toggle="tab"
                                        data-bs-target="#btabs-animated-slideleft-visitas" role="tab"
                                        aria-controls="btabs-animated-slideleft-visitas" aria-selected="true">Visitas
                                </button>
                            </li>
                        </ul>
                        <div class="block-content tab-content overflow-hidden">
                            <div class="tab-pane fade fade-left show active"
                                 id="btabs-animated-slideleft-dados"
                                 role="tabpanel" aria-labelledby="btabs-animated-slideleft-dados-tab">
                                <form
                                    action="{{isset($desabrigado) ? route('desabrigado.update', $desabrigado->id) : route('desabrigado.store')}}"
                                    method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($desabrigado))
                                        @method('PUT')
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                                <input type="text" class="form-control" id="nome" name="nome"
                                                       value="{{ isset($desabrigado) ? $desabrigado->nome : ''}}"
                                                       required
                                                       autofocus autocomplete="off"
                                                       placeholder="Nome">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                                <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                                                       value="{{ isset($desabrigado) ? $desabrigado->sobrenome : ''}}"
                                                       required
                                                       autocomplete="off" placeholder="Sobrenome">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-address-card"></i>
                        </span>
                                                <input type="text" class="form-control" id="rg" name="rg"
                                                       value="{{ isset($desabrigado) ? $desabrigado->rg : ''}}"
                                                       autocomplete="off" placeholder="RG">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-address-card"></i>
                        </span>
                                                <input type="text" class="form-control" id="cpf" name="cpf"
                                                       value="{{ isset($desabrigado) ? $desabrigado->cpf : ''}}"
                                                       autocomplete="off" placeholder="000.000.000-00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-address-card"></i>
                        </span>
                                                <input type="text" class="form-control" id="certidao_nascimento"
                                                       name="certidao_nascimento"
                                                       value="{{ isset($desabrigado) ? $desabrigado->certidao_nascimento : ''}}"
                                                       autocomplete="off" placeholder="Certidão de Nascimento">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-address-card"></i>
                        </span>
                                                <input type="text" class="form-control" id="cartao_sus"
                                                       name="cartao_sus"
                                                       value="{{ isset($desabrigado) ? $desabrigado->cartao_sus : ''}}"
                                                       autocomplete="off" placeholder="Cartão SUS">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-lg btn-success">
                                                <i class="far fa fa-save me-1"></i> Salvar
                                            </button>
                                            <a href="{{route('desabrigado.index')}}"
                                               class="btn btn-lg btn-outline-info">Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                <div class="tab-pane fade fade-left"
                                     id="btabs-animated-slideleft-visitas"
                                     role="tabpanel" aria-labelledby="btabs-animated-slideleft-visitas-tab">

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
