<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>::TeEncontrei - Administração::</title>

    <meta name="description"
          content="">
    <meta name="author" content="Isaque Oliveira">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/dashmix.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/select2/css/select2.min.css')}}">
    <!-- END Stylesheets -->
</head>
<body>
<div id="page-container"
     class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="bg-header-dark">
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="fw-semibold text-white tracking-wide" href="#">
              <span class="smini-visible">
                A<span class="opacity-75">a</span>
              </span>
                    <span class="smini-hidden">
                Te<span class="opacity-75">Encontrei</span>
              </span>
                </a>
                <!-- END Logo -->

                <!-- Options -->
                <div>
                    <!-- Toggle Sidebar Style -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                            onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                        <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                    </button>
                    <!-- END Toggle Sidebar Style -->

                    <!-- Dark Mode -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#dark-mode-toggler" data-class="far fa"
                            onclick="Dashmix.layout('dark_mode_toggle');">
                        <i class="far fa-moon" id="dark-mode-toggler"></i>
                    </button>
                    <!-- END Dark Mode -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                        <i class="fa fa-times-circle"></i>
                    </button>
                    <!-- END Close Sidebar -->
                </div>
                <!-- END Options -->
            </div>
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('administracao.dashboard')}}">
                            <i class="nav-main-link-icon fa fa-chart-bar"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="true" href="#">
                            <i class="nav-main-link-icon fa fa-building"></i>
                            <span class="nav-main-link-name">Instituições</span>
                            <span class="nav-main-link-badge badge rounded-pill bg-primary">{{ \App\Models\Instituicao::count() }}</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('instituicao.index') }}">
                                    <span class="nav-main-link-name">Listar</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('instituicao.buscarEndereco') }}">
                                    <span class="nav-main-link-name">Cadastrar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                           aria-expanded="true" href="#">
                            <i class="nav-main-link-icon fa fa-users"></i>
                            <span class="nav-main-link-name">Usuários</span>
                            <span class="nav-main-link-badge badge rounded-pill bg-primary">{{ \App\Models\User::count() }}</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('user.index') }}">
                                    <span class="nav-main-link-name">Listar</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('user.create')}}">
                                    <span class="nav-main-link-name">Cadastrar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('endereco.index')}}">
                            <i class="nav-main-link-icon fa fa-address-book"></i>
                            <span class="nav-main-link-name">Endereços</span>
                            <span
                                class="nav-main-link-badge badge rounded-pill bg-primary">{{ \App\Models\Endereco::count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="space-x-1">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="space-x-1">
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">Perfil</span>
                        <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                            Minha conta
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item" href="{{route('user.edit')}}">
                                <i class="far fa-fw fa-user me-1"></i> Meus dados
                            </a>

                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}">
                                <i class="far fa-fw fa-arrow-alt-circle-left me-1"></i> Sair
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Dropdown -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">@yield('titulo')</h1>
                    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach($migalhas as $k => $migalha)
                                <li class="breadcrumb-item{{ $k + 1 == count($migalhas) ? ' active' : ''}}">
                                    @if($k + 1 < count($migalhas))
                                        <a href="{{ $migalha['link'] }}">{{$migalha['item']}}</a>
                                    @else
                                        {{ $migalha['item'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        @yield('conteudo')
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-0">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                    <a class="fw-semibold" href="#" target="_blank">TeEncontrei</a> &copy;
                    <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">Você tem certeza que deseja excluir?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p id="nomeItem"></p>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Não</button>
                        <a href="#" id="btnModalDelete" class="btn btn-sm btn-danger">Sim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Container -->

<!--
  Dashmix JS

  Core libraries and functionality
  webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script>Dashmix.helpersOnLoad(['jq-notify', 'jq-select2']);</script>
<script>
    $(document).ready(function () {
        @if(!is_null(session('mensagem')))
        Dashmix.helpers('jq-notify', {
            type: '{{session('tipo')}}',
            icon: 'fa fa-exclamation me-1',
            message: '{{session('mensagem')}}'
        });
        @endif
        $("#cep").mask("99999-999", {placeholder:"0"});
        $('#modalDelete').on('show.bs.modal', function (event) {
            let params = $(event.relatedTarget)
            let id = params.data('id')
            let item = params.data('item')
            let url = params.data('url')
            let modal = $(this)
            modal.find('#nomeItem').html(item);
            modal.find('#btnModalDelete').attr('href', url + '?id=' + id);
        })
    });
</script>
</body>
</html>
