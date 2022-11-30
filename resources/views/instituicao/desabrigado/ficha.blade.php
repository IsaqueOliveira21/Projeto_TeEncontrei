<h1 style=" font-family: Roboto,sans-serif;text-align: center;">{{\Illuminate\Support\Facades\Auth::user()->colaborador->instituicao->nomeclatura}}</h1>
<h2 style=" font-family: Roboto,sans-serif; outline-style: auto; outline-color: black; outline-width: 2px; padding: 30px">Ficha de Cadastro: {{"{$desabrigado->nome} {$desabrigado->sobrenome}"}}</h2>

<ul style="list-style: none; outline-style: auto; outline-color: black; outline-width: 2px; padding: 50px">
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>Número de Registro:</b> {{$desabrigado->id}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>Nome:</b> {{$desabrigado->nome}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>Sobrenome:</b> {{$desabrigado->sobrenome}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>CPF:</b> {{$desabrigado->cpf}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>RG:</b> {{$desabrigado->rg}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>Certidão de Nascimento:</b> {{$desabrigado->certidao_nascimento}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>Cartão SUS:</b> {{$desabrigado->cartao_sus}}</li>
    <li style="margin-bottom: 10px; font-family: Roboto,sans-serif; font-size: 30px;"><b>Cadastrado em:</b> {{$desabrigado->created_at->format('d/m/Y')}}</li>
</ul>

<footer style="padding-top: 30px; text-align: center">
    <h3 style="font-family: Roboto,sans-serif;">{{now()->format('d/m/Y')}}</h3>
</footer>
