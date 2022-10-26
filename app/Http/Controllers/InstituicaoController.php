<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function index(Request $request)
    {
        $instituicoes = Instituicao::where('nomeclatura', 'LIKE', "%{$request->pesquisa}%")
            ->orderBy('nomeclatura')
            ->paginate(10);
        return view('administracao.instituicao.index', compact('instituicoes'));
    }

    public function create()
    {
        return view('administracao.endereco.busca_endereco');
    }

    public function store(Request $request)
    {
        try{
            Instituicao::create([
                'endereco_id' => $request->endereco_id,
                'nomeclatura' => $request->nomeclatura,
                'capacidade' => $request->capacidade,
                'numero_enderceo' => $request->numero_endereco
            ]);
            return redirect()->route('instituicao.index')->with(['tipo' => 'success', 'mensagem' => 'Nova instituição cadastrada com sucesso']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }
}
