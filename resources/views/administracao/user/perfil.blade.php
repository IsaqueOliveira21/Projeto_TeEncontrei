@extends('administracao.template')

@section('titulo', 'ATUALIZE SEUS DADOS')

@php
    $migalhas = [
        ['item' => 'USUÁRIOS', 'link' => Route('user.index')],
        ['item' => 'EDITAR PERFIL', 'link' => '#'],
        ];
@endphp

@section('conteudo')
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="content">
                <div class="block block-rounded">
                    <div class="block-content">
                        <form action="{{route('user.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-xs-12 mb-3">
                                    <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{Auth::user()->name}}" required autofocus autocomplete="off"
                                               placeholder="Nome do Usuário">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 mb-3">
                                    <div class="input-group">
                        <span class="input-group-text">
                          <i class="far fa-user"></i>
                        </span>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               value="{{Auth::user()->last_name}}" required
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
                                        <input type="email" class="form-control" id="email" name="email" required
                                               value="{{Auth::user()->email}}"
                                               autocomplete="off" placeholder="E-mail do Usuário">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-12 mb-3">
                                    <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-user-lock"></i>
                        </span>
                                        <input type="password" class="form-control" id="current_password"
                                               name="current_password" required
                                               autocomplete="off" placeholder="Senha atual">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 mb-3">
                                    <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-user-lock"></i>
                        </span>
                                        <input type="password" class="form-control" id="password" name="password"
                                               required
                                               autocomplete="off" placeholder="Nova Senha do Usuário">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 mb-3">
                                    <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-user-lock"></i>
                        </span>
                                        <input type="password" class="form-control" id="confirm_password"
                                               name="confirm_password" required
                                               autocomplete="off" placeholder="Confirmar Nova Senha">
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="content">
                <div class="block block-rounded">
                    <div class="block-content block-content-full text-center mb-4">
                        <img
                            src="{{!is_null(Auth::user()->photo) ? asset('storage/photos/'.Auth::user()->photo) : asset('assets/media/avatars/avatar15.jpg')}}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
