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

    public function buscarEndereco(Instituicao $instituicao = null)
    {
        return view('administracao.endereco.busca_endereco', compact('instituicao'));
    }

    public function store(Request $request)
    {
        try {
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

    public function edit(Instituicao $instituicao)
    {
        $endereco = $instituicao->endereco;
        return view('administracao.instituicao.dados', compact('instituicao', 'endereco'));
    }

    public function update(Instituicao $instituicao, Request $request)
    {
        try {
            $instituicao->nomeclatura = $request->nomeclatura;
            $instituicao->capacidade = $request->capacidade;
            $instituicao->endereco_id = $request->endereco_id;
            $instituicao->numero_endereco = $request->numero_endereco;
            $instituicao->save();
            return redirect()->route('instituicao.edit', $instituicao->id)->with(['tipo' => 'success', 'mensagem' => 'Instituição atualizada com sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }
}
