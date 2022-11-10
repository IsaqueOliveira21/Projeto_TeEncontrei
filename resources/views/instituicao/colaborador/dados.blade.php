@extends('instituicao.template')

@section('titulo', isset($colaborador) ? 'EDITAR COLABORADOR' : 'CADASTRAR COLABORADOR')

@php
    $migalhas = [
        ['item' => 'COLABORADORES', 'link' => route('colaborador.index')],
        ['item' => isset($colaborador) ? 'EDITAR COLABORADOR' : 'CADASTRAR COLABORADOR', 'link' => '#']
];
@endphp
@section('conteudo')
    <div class="content">
        <div class="row">
            <div class="block block-rounded {{isset($colaborador) ? 'col-md-10' : ''}} col-xs-12">
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
                                    id="btabs-animated-slideleft-telefones-tab" data-bs-toggle="tab"
                                    data-bs-target="#btabs-animated-slideleft-telefones" role="tab"
                                    aria-controls="btabs-animated-slideleft-telefones" aria-selected="true">Telefones
                            </button>
                        </li>
                    </ul>

                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left show active"
                             id="btabs-animated-slideleft-dados"
                             role="tabpanel" aria-labelledby="btabs-animated-slideleft-dados-tab">
                            <form method="POST"
                                  action="{{ isset($colaborador) ? route('colaborador.update', $colaborador->id) : route('colaborador.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @if(isset($colaborador))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 mb-4">
                                        <input type="hidden" name="endereco_id" value="{{$endereco->id}}">
                                        <label class="form-label" for="name">Nome</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{isset($colaborador) ? $colaborador->user->name : ''}}"
                                               required
                                               placeholder="Nome do colaborador" autofocus>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 mb-4">
                                        <label class="form-label" for="last_name">Sobrenome</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               value="{{isset($colaborador) ? $colaborador->user->last_name : ''}}"
                                               required
                                               placeholder="Sobrenome">
                                    </div>
                                    <div class="col-sm-6 col-xs-12 mb-4">
                                        <label class="form-label" for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{isset($colaborador) ? $colaborador->user->email : ''}}"
                                               required
                                               placeholder="E-mail">
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-12 mb-4">
                                            <label class="form-label" for="password">Senha</label>
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-user-lock"></i>
                        </span>
                                                <input type="password" class="form-control" id="password"
                                                       name="password"
                                                       required
                                                       autocomplete="off" placeholder="Nova Senha do Usuário">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12 mb-4">
                                            <label class="form-label" for="confirm_passwordpassword">Confirmar
                                                Senha</label>
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-user-lock"></i>
                        </span>
                                                <input type="password" class="form-control" id="confirm_password"
                                                       name="confirm_password" required
                                                       autocomplete="off" placeholder="Confirmar Nova Senha">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12 mb-4">
                                            <label class="form-label" for="cargo">Cargo</label>
                                            <select class="js-select2 form-select" id="cargo"
                                                    name="cargo"
                                                    style="width: 100%;" data-placeholder="Selecione...">
                                                <option value=""></option>
                                                @foreach($cargos as $cargo)
                                                    <option
                                                        value="{{ $cargo }}" {{(isset($colaborador) && $cargo == $colaborador->cargo) ? 'selected' : ''}}>{{$cargo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-xs-12 mb-4">
                                            <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                                            <div class="col-xl-4 mb-4">
                                                <input type="text" class="js-datepicker form-control"
                                                       id="data_nascimento"
                                                       value="{{ isset($colaborador) ? $colaborador->data_nascimento->format('d/m/Y') : '' }}"
                                                       name="data_nascimento" data-week-start="1" data-autoclose="true"
                                                       data-today-highlight="true" data-date-format="dd/mm/yyyy"
                                                       placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-2 col-xs-12 mb-4">
                                        <label class="form-label" for="cep">CEP</label>
                                        <input type="tel" class="form-control" id="cep" name="cep" readonly
                                               value="{{$endereco->cep}}"
                                               required
                                               placeholder="00000-000">
                                    </div>
                                    <div class="col-md-2 col-xs-12 mb-4">
                                        <label class="form-label" for="tipo_logradouro">Tipo</label>
                                        <input type="text" class="form-control" id="tipo_logradouro"
                                               name="tipo_logradouro"
                                               readonly
                                               value="{{$endereco->tipo_logradouro}}">
                                    </div>
                                    <div class="col-md-4 col-xs-12 mb-4">
                                        <label class="form-label" for="logradouro">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro"
                                               readonly
                                               value="{{$endereco->logradouro}}">
                                    </div>
                                    <div class="col-md-2 col-xs-12 mb-4">
                                        <label class="form-label" for="numero_endereco">Nº</label>
                                        <input type="text" class="form-control" id="numero_endereco"
                                               name="numero_endereco"
                                               value="{{isset($colaborador) ? $colaborador->numero_endereco : ''}}"
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
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-photo-video"></i>
                        </span>
                                            <input class="form-control" type="file" id="photo" name="photo"
                                                   accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <button type="submit" class="btn btn-lg btn-success">
                                            <i class="far fa fa-save me-1"></i>Salvar
                                        </button>
                                        @if(isset($colaborador))
                                            <a href="{{ route('colaborador.buscarEndereco', $colaborador->id) }}"
                                               class="btn btn-lg btn-secondary">
                                                <i class="far fa fa-address-book me-1"></i>Alterar Endereço
                                            </a>
                                        @endif
                                        <a href="{{route('colaborador.index')}}"
                                           class="btn btn-lg btn-outline-info">Voltar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade fade-left"
                             id="btabs-animated-slideleft-telefones"
                             role="tabpanel" aria-labelledby="btabs-animated-slideleft-telefones-tab">
                            <form method="POST" action="{{ route('colaborador.telefone.store', $colaborador->id) }}" enctype="application/x-www-form-urlencoded">
                                @csrf
                                <h2>{{ $colaborador->user->name . ' ' . $colaborador->user->last_name }}</h2>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="numero_telefone">Telefone</label>
                                        <div class="input-group">
                                            <input type="tel" class="form-control" id="numero_telefone" name="numero_telefone"
                                                   value=""
                                                   required
                                                   placeholder="Número de telefone" autofocus>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa fa-phone me-1"></i>Salvar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <table class="table table-vcenter table-striped table-hover">
                                    <thead>
                                        <tr class="bg-body-dark">
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th style="width: 60%">Telefones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($colaborador->telefones as $telefone)
                                        <tr>
                                            <td>#</td>
                                            <td>{{ $telefone->numero_telefone }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">Nenhum número de telefone registrado ainda.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($colaborador))
                <div class="block block-rounded col-md-2 col-xs-12">
                    <div class="block-content">
                        <img
                            src="{{!is_null($colaborador->user->photo) ? asset('storage/photos/'.$colaborador->user->photo) : asset('assets/media/avatars/avatar15.jpg')}}"
                            alt="">
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
