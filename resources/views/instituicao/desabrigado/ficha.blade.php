<h1 style="text-align: center;">{{\Illuminate\Support\Facades\Auth::user()->colaborador->instituicao->nomeclatura}}</h1>
<h2 style="outline-style: auto; outline-color: black; outline-width: 2px; padding: 30px">Ficha de Cadastro: {{"{$desabrigado->nome} {$desabrigado->sobrenome}"}}</h2>

<ul style="list-style: none; outline-style: auto; outline-color: black; outline-width: 2px; padding: 50px">
    <li style="margin-bottom: 10px;"><b>Nome:</b> {{$desabrigado->nome}}</li>
    <li style="margin-bottom: 10px;"><b>Sobrenome:</b> {{$desabrigado->sobrenome}}</li>
    <li style="margin-bottom: 10px;"><b>CPF:</b> {{$desabrigado->cpf}}</li>
    <li style="margin-bottom: 10px;"><b>RG:</b> {{$desabrigado->rg}}</li>
    <li style="margin-bottom: 10px;"><b>Certidão de Nascimento:</b> {{$desabrigado->certidao_nascimento}}</li>
    <li style="margin-bottom: 10px;"><b>Cartão SUS:</b> {{$desabrigado->cartao_sus}}</li>
    <li style="margin-bottom: 10px;"><b>Cadastrado em:</b> {{$desabrigado->created_at->format('d/m/Y')}}</li>
</ul>

<footer style="padding-top: 30px; text-align: center">
    <h3>{{now()->format('d/m/Y')}}</h3>
</footer>
