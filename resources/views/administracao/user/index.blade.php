@extends('administracao.template')
@section('titulo', 'LISTAGEM DE USUÁRIOS')
@php
    $migalhas = [
        ['item'=>'USERS', 'link'=>'#']
]
@endphp

@section('conteudo')
    <div class="row">
        <form method="get" action="{{route('user.index')}}" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="content">
                <div class="block block-rounded">
                    <div class="block-content">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control form-control-alt" id="pesquisa"
                                   name="pesquisa" value="{{$_GET['pesquisa'] ?? ''}}"
                                   placeholder="Pesquisar usuário..." autofocus>
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-search me-1"></i> Pesquisar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    @forelse($users as $user)
                        <div class="col-md-3 col-xs-1">
                            <a class="block block-rounded text-center" href="javascript:void(0)">
                                <div
                                    class="block-content block-content-full block-content-sm bg-primary border-bottom border-white-op">
                                    <p class="fw-semibold text-white mb-0">{{Str::limit("{$user->name} {$user->last_name}", 15, '...')}}</p>
                                </div>
                                <div class="block-content block-content-full bg-primary">
                                    <img class="img-avatar img-avatar-thumb img-avatar-rounded"
                                         src="{{!is_null($user->photo) ? asset("storage/photos/{$user->photo}") : asset('assets/media/avatars/avatar15.jpg')}}" alt="">
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row g-sm">
                                        <div class="col-6">
                                            <a href="{{route('user.edit', $user->id)}}">
                                                <div
                                                    class="item item-circle mb-3 mx-auto border border-primary border-2">
                                                    <i class="si si-pencil text-primary"></i>
                                                </div>
                                                <p class="fs-sm fw-medium text-muted mb-0 text-center">
                                                    Editar
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="{{$user->id}}" data-item="{{$user->name.' '.$user->last_name}}" data-url="delete">
                                                <div
                                                    class="item item-circle mb-3 mx-auto border border-primary border-2">
                                                    <i class="far fa-fw fa-trash-alt text-primary"></i>
                                                </div>
                                                <p class="fs-sm fw-medium text-muted mb-0 text-center">
                                                    Excluir
                                                </p>
                                            </a>
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
    @if($users->count() > 0)
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="col-12">
                        @if(isset($_GET['pesquisa']))
                            {{ $users->appends($_GET)->links() }}
                        @else
                            {{ $users->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function deletarUsuario(id) {
            if (confirm('Deseja realmente remover este usuário?')) {
                window.location.href = '{{route('user.delete')}}?id=' + id;
            }
        }
    </script>
@endsection
