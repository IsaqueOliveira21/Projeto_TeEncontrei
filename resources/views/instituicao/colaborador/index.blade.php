@extends('instituicao.template')

@section('titulo', 'COLABORADORES')

@php
    $migalhas = [
        ['item' => 'COLABORADORES', 'link' => '#']
];
@endphp

@section('conteudo')
    <form method="get" action="{{route('colaborador.index')}}" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control form-control-alt" id="pesquisa"
                               name="pesquisa" value="{{$_GET['pesquisa'] ?? ''}}"
                               placeholder="Pesquisar colaborador..." autofocus>
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-search me-1"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    @forelse($colaboradores as $colaborador)
                        <div class="col-md-3 col-xs-1">
                            <a class="block block-rounded text-center" href="javascript:void(0)">
                                <div
                                    class="block-content block-content-full block-content-sm bg-primary border-bottom border-white-op">
                                    <p class="fw-semibold text-white mb-0">{{Str::limit("{$colaborador->name} {$colaborador->last_name}", 15, '...')}}</p>
                                </div>
                                <div class="block-content block-content-full bg-primary">
                                    <img class="img-avatar img-avatar-thumb img-avatar-rounded"
                                         src="{{isset($colaborador->photo) ? asset("storage/photos/{$colaborador->photo}") : asset('assets/media/avatars/avatar15.jpg')}}" alt="">
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row g-sm">
                                        <div class="col-6">
                                            <a href="{{route('colaborador.edit', $colaborador->id)}}">
                                                <div
                                                    class="item item-circle mb-3 mx-auto border border-primary border-2">
                                                    <i class="fa fa-user-edit text-primary text-center"></i>
                                                </div>
                                                <p class="fs-sm fw-medium text-muted mb-0 text-center">
                                                    Editar
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <div class="btn-group">
                                                <div class="col-6">
                                                    <a href="{{route('colaborador.status', $colaborador->id)}}">
                                                        <div class="item item-circle mb-3 mx-auto border border-primary border-2">
                                                            <i class="{{$colaborador->ativo ? 'fa fa-user-slash' : 'fa fa-user'}} text-primary text-center"></i>
                                                        </div>
                                                        <p class="fs-sm fw-medium text-muted mb-0 text-center">
                                                            {{$colaborador->ativo ? 'Desativar' : 'Ativar'}}
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 mb-3 text-center">
                            Nenhum usuário encontrado
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
