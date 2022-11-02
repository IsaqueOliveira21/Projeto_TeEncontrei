<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class EnderecoController extends Controller
{
    private $tiposLogradouros = [
        'Rua',
        'Avenida',
        'Praça',
        'Travessa'
    ];

    public function buscarEnderecoInstituicao(Instituicao $instituicao = null, Request $request)
    {
        $endereco = Endereco::where('cep', $request->cep)->first();
        if ($endereco) {
            return view('administracao.instituicao.dados', compact('endereco', 'instituicao'));
        } else {
            $cep = $request->cep;
            $tiposLogradouros = $this->tiposLogradouros;
            return view('administracao.endereco.dados', compact(['cep', 'tiposLogradouros', 'instituicao']));
        }
    }

    public function index(Request $request)
    {
        $enderecos = Endereco::where('cep', $request->pesquisa)
            ->orWhere('logradouro', 'LIKE', "%{$request->pesquisa}%")
            ->orderBy('logradouro')
            ->paginate(20);
        return view('administracao.endereco.index', compact('enderecos'));
    }

    public function storeInstituicao(Instituicao $instituicao, Request $request)
    {
        try {
            $endereco = Endereco::create([
                'cep' => $request->cep,
                'tipo_logradouro' => $request->tipo_logradouro,
                'logradouro' => $request->logradouro,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf
            ]);
            return view('administracao.instituicao.dados', compact('endereco', 'instituicao'));
        } catch (Exception $e) {
            redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function edit(Endereco $endereco)
    {
        $tiposLogradouros = $this->tiposLogradouros;
        $instituicoes = $endereco->instituicoes()->orderBy('nomeclatura')->paginate(10);
        return view('administracao.endereco.dados', compact('endereco', 'tiposLogradouros', 'instituicoes'));
    }

    public function update(Endereco $endereco, Request $request)
    {
        try {
            $endereco->cep = $request->cep;
            $endereco->tipo_logradouro = $request->tipo_logradouro;
            $endereco->logradouro = $request->logradouro;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->uf = $request->uf;
            $endereco->save();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Endereço atualizado com sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        $endereco = Endereco::find($request->id);
        if ($endereco->instituicoes()->count() == 0) {
            $endereco->delete();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Endereço excluído com sucesso!']);
        } else {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => 'Não é possível excluir este endereço!']);
        }
    }

}
