<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>::ACHEI AQUI::</title>

    <meta name="description" content="">
    <meta name="author" content="Isaque Oliveira">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="assets/css/dashmix.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/xwork.min.css"> -->
    <!-- END Stylesheets -->
</head>
<body>

<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('assets/media/photos/photo19@2x.jpg')}}');">
            <div class="row g-0 justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Sign In Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div
                            class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx fw-bold fs-1" href="#">
                                    <span class="text-dark">Achei</span><span class="text-primary">Aqui</span>
                                </a>
                                <p class="text-uppercase fw-bold fs-sm text-muted">Seja Bem Vindo</p>
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{route('user.postLogin')}}" method="POST"
                                  enctype="application/x-www-form-urlencoded">
                                @csrf
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="email" class="form-control" id="login-username" name="email"
                                               placeholder="E-mail" required>
                                        <span class="input-group-text">
                          <i class="fa fa-user-circle"></i>
                        </span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control" id="login-password" name="password"
                                               placeholder="Senha" required>
                                        <span class="input-group-text">
                          <i class="fa fa-asterisk"></i>
                        </span>
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-hero btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Entrar
                                    </button>
                                </div>
                                @if(isset($mensagem))
                                    <div class="alert alert-danger" role="alert">
                                        <p class="mb-0">{{$mensagem}}</p>
                                    </div>
                                @endif
                            </form>
                            <!-- END Sign In Form -->
                        </div>

                        <!-- END Page Container -->
                        <script src="{{asset('assets/js/dashmix.app.min.js')}}"></script>

                        <!-- jQuery (required for jQuery Validation plugin) -->
                        <script src="{{asset('assets/js/lib/jquery.min.js')}}"></script>

                        <!-- Page JS Plugins -->
                        <script src="{{asset('assets/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

                        <!-- Page JS Code -->
                        <script src="{{asset('assets/js/pages/op_auth_signin.min.js')}}"></script>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
