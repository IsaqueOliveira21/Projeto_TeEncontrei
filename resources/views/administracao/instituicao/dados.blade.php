@extends('administracao.template')
@section('titulo', 'CADASTRAR INSTITUIÇÃO')
@php
    $migalhas = [
        ['item' => 'INSTITUIÇÕES', 'link' => route('instituicao.index')],
        ['item' => 'CADASTRAR INSTITUIÇÃO', 'link' => '#'],
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <form method="POST" action="{{route('instituicao.store')}}" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-4">
                            <input type="hidden" name="endereco_id" value="{{$endereco->id}}">
                            <label class="form-label" for="nomeclatura">Nomeclatura</label>
                            <input type="text" class="form-control" id="nomeclatura" name="nomeclatura" value=""
                                   required
                                   placeholder="Nomeclatura" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-12 mb-4">
                            <label class="form-label" for="capacidade">Capacidade</label>
                            <input type="number" class="form-control" id="capacidade" name="capacidade" value=""
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
                            <input type="text" class="form-control" id="tipo_logradouro" name="tipo_logradouro" readonly
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
                                   value="" placeholder="Numero">
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
