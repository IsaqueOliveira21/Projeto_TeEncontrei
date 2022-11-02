@extends('administracao.template')

@section('titulo', isset($user) ? 'ATUALIZAR USUÁRIO' : 'CADASTRAR USUÁRIO')

@php
    $migalhas = [
        ['item' => 'USUÁRIOS', 'link' => Route('user.index')],
        ['item' => isset($user) ? 'ATUALIZAR USÁRIO' : 'CADASTRAR USUÁRIO', 'link' => '#'],
        ];
@endphp

@section('conteudo')
    <div class="row">
        <div class="col-md-9">
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
                        </ul>
                        <div class="block-content tab-content overflow-hidden">
                            <div class="tab-pane fade fade-left show active"
                                 id="btabs-animated-slideleft-dados"
                                 role="tabpanel" aria-labelledby="btabs-animated-slideleft-dados-tab">
                                <form
                                    action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                                    method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($user))
                                        @method('PUT')
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{ isset($user) ? $user->name : ''}}" required
                                                       autofocus autocomplete="off"
                                                       placeholder="Nome do Usuário">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12 mb-3">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                       value="{{ isset($user) ? $user->last_name : ''}}"
                                                       required
                                                       autocomplete="off" placeholder="Sobrenome do Usuário">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       required
                                                       value="{{ isset($user) ? $user->email : ''}}"
                                                       autocomplete="off" placeholder="E-mail do Usuário">
                                            </div>
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
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-lg btn-success">
                                                <i class="far fa fa-save me-1"></i> Salvar
                                            </button>
                                            @if(isset($user))
                                                <button type="button" href="#" class="btn btn-lg btn-outline-warning"
                                                        onclick="redefinirSenha()">
                                                    Redefinir Senha
                                                </button>
                                            @endif
                                            <a href="{{route('user.index')}}"
                                               class="btn btn-lg btn-outline-info">Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="content">
                <div class="block block-rounded">
                    <div class="block-content block-content-full text-center mb-4">
                        <img
                            src="{{ isset($user) && !is_null($user->photo) ? asset('storage/photos/'.$user->photo) : asset('assets/media/avatars/avatar15.jpg') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if(isset($user))
        function redefinirSenha() {
            if (confirm('Deseja redefinir a senha do usuário {{$user->name}}')) {
                window.location.href = '{{ route('user.redefinir.senha', $user->id) }}';
            }
        }

        @endif
    </script>

@endsection
