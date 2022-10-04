<html>
<head>
    <title>::ACHEI_AQUI::</title>
</head>
<body>
    <form method="post" action="{{route('user.postLogin')}}" enctype="application/x-www-form-urlencoded">
        <h2>Seja Bem Vindo</h2>
        @csrf
        <p>{{ $mensagem ?? '' }}</p>
        <label for="email">E-mail:</label>
        <input type="email" name="email" maxlength="255" required autofocus placeholder="E-mail" autocomplete="off"/>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" maxlength="12" required placeholder="******">
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
