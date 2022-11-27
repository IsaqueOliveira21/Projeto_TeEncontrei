@extends('instituicao.template')
@section('titulo', isset($colaborador) ? 'EDITAR COLABORADOR' : 'CADASTRAR COLABORADOR')
@php
    $migalhas = [
        ['item' => 'COLABORADORES', 'link' => route('colaborador.index')],
        ['item' => isset($colaborador) ? 'EDITAR COLABORADOR' : 'CADASTRAR COLABORADOR', 'link' => '#'],
    ];
@endphp
@section('conteudo')
    <div class="content">
        <div class="row">
            <div class="block block-rounded {{ isset($colaborador) ? 'col-md-10' : 'col-md-12' }} col-xs-12">
                <div class="block-content">
                    <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link {{!isset($aba) ? 'active' : ''}}"
                                    id="btabs-animated-slideleft-dados-tab" data-bs-toggle="tab"
                                    data-bs-target="#btabs-animated-slideleft-dados" role="tab"
                                    aria-controls="btabs-animated-slideleft-dados" aria-selected="true">Dados
                            </button>
                        </li>
                        @if(isset($colaborador))
                            <li class="nav-item">
                                <button class="nav-link {{(isset($aba) && $aba = 'telefones') ? 'active' : ''}}"
                                        id="btabs-animated-slideleft-telefones-tab" data-bs-toggle="tab"
                                        data-bs-target="#btabs-animated-slideleft-telefones" role="tab"
                                        aria-controls="btabs-animated-slideleft-telefones" aria-selected="true">
                                    Telefones
                                </button>
                            </li>
                        @endif
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div
                            class="tab-pane fade fade-left {{!isset($aba) ? 'show active' : ''}}"
                            id="btabs-animated-slideleft-dados" role="tabpanel"
                            aria-labelledby="btabs-animated-slideleft-dados-tab">
                            <form method="post"
                                  action="{{ isset($colaborador) ? route('colaborador.update', $colaborador->id) : route('colaborador.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @if(isset($colaborador))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 mb-4">
                                        <input type="hidden" name="endereco_id" value="{{ $endereco->id }}">
                                        <label class="form-label" for="name">Nome</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ isset($colaborador) ? $colaborador->user->name : '' }}"
                                               required autofocus placeholder="Nome do colaborador">
                                    </div>
                                    <div class="col-sm-6 col-xs-12 mb-4">
                                        <label class="form-label" for="last_name">Sobrenome</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               value="{{ isset($colaborador) ? $colaborador->user->last_name : '' }}"
                                               required placeholder="Sobrenome do colaborador">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ isset($colaborador) ? $colaborador->user->email : '' }}"
                                               required placeholder="Endereço de e-mail">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-xs-12 mb-4">
                                        <label class="form-label" for="password">Nova senha</label>
                                        <div class="input-group">
                                        <span class="input-group-text">
                                          <i class="fa fa-user-lock"></i>
                                        </span>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   required autocomplete="off" placeholder="Nova senha">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 mb-4">
                                        <label class="form-label" for="confirm_password">Confirmar senha</label>
                                        <div class="input-group">
                                        <span class="input-group-text">
                                          <i class="fa fa-user-lock"></i>
                                        </span>
                                            <input type="password" class="form-control" id="confirm_password"
                                                   name="confirm_password" required autocomplete="off"
                                                   placeholder="Confirmar nova senha">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 mb-4">
                                        <label class="form-label" for="cargo">Cargo</label>
                                        <select class="js-select2 form-select" id="cargo" name="cargo"
                                                style="width: 100%;" required data-placeholder="Selecione...">
                                            <option value=""></option>
                                            @foreach($cargos as $cargo)
                                                <option
                                                    value="{{ $cargo }}" {{(isset($colaborador) && $cargo == $colaborador->cargo) ? 'selected' : ''}}>{{ $cargo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-xs-12 mb-4">
                                        <label class="form-label" for="data_nascimento">Data de nascimento</label>
                                        <input type="text" class="js-datepicker form-control" id="data_nascimento"
                                               value="{{ isset($colaborador) ? $colaborador->data_nascimento->format('d/m/Y') : '' }}"
                                               name="data_nascimento" data-week-start="1" data-autoclose="true"
                                               data-today-highlight="true" data-date-format="dd/mm/yyyy"
                                               placeholder="dd/mm/yyyy" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-sx-12 mb-4">
                                        <label class="form-label" for="cep">Cep</label>
                                        <input type="tel" class="form-control" id="cep" name="cep"
                                               value="{{ $endereco->cep }}" readonly>
                                    </div>
                                    <div class="col-md-2 col-sx-12 mb-4">
                                        <label class="form-label" for="tipo_logradouro">Tipo</label>
                                        <input type="text" class="form-control" id="tipo_logradouro"
                                               name="tipo_logradouro" value="{{ $endereco->tipo_logradouro }}" readonly>
                                    </div>
                                    <div class="col-md-6 col-sx-12 mb-4">
                                        <label class="form-label" for="logradouro">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro"
                                               value="{{ $endereco->logradouro }}" readonly>
                                    </div>
                                    <div class="col-md-2 col-sx-12 mb-4">
                                        <label class="form-label" for="numero_endereco">Nº</label>
                                        <input type="text" class="form-control" id="numero_endereco"
                                               name="numero_endereco"
                                               value="{{ isset($colaborador) ? $colaborador->numero_endereco : '' }}"
                                               required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sx-12 mb-4">
                                        <label class="form-label" for="bairro">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro"
                                               value="{{ $endereco->bairro }}" readonly>
                                    </div>
                                    <div class="col-md-5 col-sx-12 mb-4">
                                        <label class="form-label" for="cidade">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade"
                                               value="{{ $endereco->cidade }}" readonly>
                                    </div>
                                    <div class="col-md-2 col-sx-12 mb-4">
                                        <label class="form-label" for="uf">UF</label>
                                        <input type="text" class="form-control" id="uf" name="uf"
                                               value="{{ $endereco->uf }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-4">
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
                                                <i class="far fa fa-address-book me-1"></i>Alterar endereço
                                            </a>
                                            <a href="{{route('colaborador.buscarEndereco')}}"
                                               class="btn btn-lg btn-primary">
                                                <i class="fa fa-plus me-1"></i>Novo
                                            </a>
                                        @endif
                                        <a href="{{ route('colaborador.index') }}" class="btn btn-lg btn-outline-info">Voltar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if(isset($colaborador))
                            <div class="tab-pane fade fade-left {{ (isset($aba) && $aba = 'telefones') ? 'show active' : '' }}" id="btabs-animated-slideleft-telefones" role="tabpanel"
                                 aria-labelledby="btabs-animated-slideleft-telefones-tab">
                                <form method="post" action="{{ route('colaborador.telefone.store', $colaborador->id) }}"
                                      enctype="application/x-www-form-urlencoded">
                                    @csrf
                                    <h2>{{ $colaborador->user->name . ' ' . $colaborador->user->last_name }}</h2>
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="form-label" for="numero_telefone">Telefone</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="numero_telefone"
                                                       name="numero_telefone" value="" required
                                                       placeholder="(00) 00000-0000">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa fa-phone me-1"></i>
                                                    Salvar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <table class="table table-vcenter table-striped table-hover table-responsive">
                                        <thead>
                                        <tr class="bg-body-dark">
                                            <th class="text-center" style="width: 10%;">#</th>
                                            <th>Telefone</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($colaborador->telefones as $telefone)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="#" onclick="deleteTelefone({{$telefone->id}})" class="btn btn-sm btn-alt-danger"
                                                       data-bs-toggle="tooltip"
                                                       title="Deletar">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $telefone->numero_telefone }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">Nenhum número registrado ainda</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(isset($colaborador))
                <div class="block block-rounded col-md-2 col-xs-12">
                    <div class="block-content">
                        <img src="{{ !is_null($colaborador->user->photo) ? asset('storage/photos/'.$colaborador->user->photo) : asset('assets/media/avatars/avatar15.jpg') }}">
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function deleteTelefone(id) {
            if(confirm('Deseja realmente apagar este telefone?')){
                window.location.href = '{{route('colaborador.telefone.delete')}}?id=' + id;
            }
        }
    </script>
@endsection
