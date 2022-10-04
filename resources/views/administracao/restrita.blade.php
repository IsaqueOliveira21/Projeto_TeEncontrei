<h2>ADMINISTRAÇÃO</h2>
<h3>Seja bem vindo: {{Auth::user()->name.' '.Auth::user()->last_name}}</h3>
<a href="{{route('logout')}}">Sair</a>
