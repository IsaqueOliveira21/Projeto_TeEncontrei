@extends(Auth::user()->colaborador()->count() == 0 ? 'administracao.template' : 'instituicao.template')

@section('titulo', 'ATUALIZE SEUS DADOS')

@php
    if(Auth::user()->colaborador()->count() == 0){
        $migalhas = [
            ['item' => 'USUÁRIOS', 'link' => Route('user.index')],
            ['item' => 'EDITAR PERFIL', 'link' => '#'],
            ];
        } else {
            $migalhas = [
                ['item' => 'EDITAR PERFIL', 'link' => '#'],
            ];
        }
@endphp

@section('conteudo')
    <div class="row">
        <div class="col-md-9 col-xs-12">
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
                                                       value="{{Auth::user()->name}}" required autofocus
                                                       autocomplete="off"
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
                                                <input type="email" class="form-control" id="email" name="email"
                                                       required
                                                       value="{{Auth::user()->email}}"
                                                       autocomplete="off" placeholder="E-mail do Usuário">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 mb-3">
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
                                        <div class="col-md-6 col-xs-12 mb-3">
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
