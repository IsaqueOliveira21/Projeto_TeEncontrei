@extends('administracao.template')
@section('titulo', 'CADASTRAR ENDERECO')
@php
    $migalhas = [
        ['item' => 'ENDEREÇO', 'link' => '#'],
        ['item' => 'CADASTRAR ENDEREÇO', 'link' => '#']
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <form method="POST" action="{{route('endereco.store')}}" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label" for="cep">CEP</label>
                            <input type="tel" class="form-control" id="cep" name="cep" value="{{$cep}}" required
                                   placeholder="00000-000" autofocus>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3 col-xs-12 mb-4">
                            <label class="form-label" for="tipo_logradouro">Tipo</label>
                            <select class="js-select2 form-select" id="tipo_logradouro" name="tipo_logradouro"
                                    style="width: 100%;" data-placeholder="Selecione...">
                                <option value=""></option>
                                @foreach($tiposLogradouros as $tipoLogradouro)
                                    <option value="{{$tipoLogradouro}}">{{$tipoLogradouro}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9 col-xs-12">
                            <label class="form-label" for="logradouro">Logradouro</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" required
                                   placeholder="Logradouro">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-xs-12 mb-4">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="" placeholder="Bairro">
                        </div>
                        <div class="col-md-5 col-xs-12 mb-4">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value="" placeholder="Cidade">
                        </div>
                        <div class="col-md-2 col-xs-12 mb-4">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf" name="uf" value="" placeholder="UF">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
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
