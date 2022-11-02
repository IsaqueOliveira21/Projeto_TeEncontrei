<?php

namespace App\Http\Controllers;

use App\Models\Desabrigado;
use Exception;
use Illuminate\Http\Request;

class DesabrigadoController extends Controller
{
    public function index(Request $request)
    {
        $desabrigados = Desabrigado::where('nome', 'LIKE', "%{$request->pesquisa}%")
            ->orWhere('sobrenome', 'LIKE', "%{$request->pesquisa}%")
            ->orWhere('cpf', 'LIKE', "{$request->pesquisa}")
            ->orderBy('nome')
            ->paginate(15);
        return view('instituicao.desabrigado.index', compact('desabrigados'));
    }

    public function create()
    {
        return view('instituicao.desabrigado.dados');
    }

    public function store(Request $request)
    {
        try {
            $desabrigado = new Desabrigado();
            $desabrigado->nome = $request->nome;
            $desabrigado->sobrenome = $request->sobrenome;
            $desabrigado->rg = $request->rg;
            $desabrigado->cpf = $request->cpf;
            $desabrigado->certidao_nascimento = $request->certidao_nascimento;
            $desabrigado->cartao_sus = $request->cartao_sus;
            $desabrigado->save();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Desabrigado cadastrado com sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function edit(Desabrigado $desabrigado)
    {
        return view('instituicao.desabrigado.dados', compact('desabrigado'));
    }

    public function update(Request $request, Desabrigado $desabrigado)
    {
        try {
            $desabrigado->nome = $request->nome;
            $desabrigado->sobrenome = $request->sobrenome;
            $desabrigado->rg = $request->rg;
            $desabrigado->cpf = $request->cpf;
            $desabrigado->certidao_nascimento = $request->certidao_nascimento;
            $desabrigado->cartao_sus = $request->cartao_sus;
            $desabrigado->save();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Desabrigado atualizado com sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => 'Não foi possível atualizar os dados!']);
        }
    }
}
