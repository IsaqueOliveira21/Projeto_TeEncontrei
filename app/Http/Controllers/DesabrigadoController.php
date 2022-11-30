<?php

namespace App\Http\Controllers;

use App\Models\Desabrigado;
use App\Models\Instituicao;
use App\Models\VisitaCabecalho;
use App\Models\VisitaDetalhe;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $visitas = $desabrigado->visitas()->where('instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->orderBy('created_at')
            ->paginate(20);
        return view('instituicao.desabrigado.dados', compact(['desabrigado', 'visitas']));
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

    public function delete(Request $request) {
        try {
            $desabrigado = Desabrigado::find($request->id);
            $desabrigado->delete();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Desabrigado removido com sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function ficha(Desabrigado $desabrigado){
        $ficha = PDF::loadView('instituicao.desabrigado.ficha', compact('desabrigado'))
            ->setPaper('a4', 'portrait')
            //->setPaper('a4', 'landscape')
            ->setOptions(['dpi' => 150, "enable_php" => true])
            ->setWarnings(true);
        return $ficha->stream("Ficha do desabrigado {$desabrigado->nome} {$desabrigado->sobrenome}.pdf");
    }
}
