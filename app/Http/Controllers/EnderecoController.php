<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class EnderecoController extends Controller
{
    public function buscarCEP(Request $request)
    {
        $endereco = Endereco::where('cep', $request->cep)->first();
        if ($endereco) {
            return view('administracao.instituicao.dados', compact('endereco'));
        } else {
            $cep = $request->cep;
            $tiposLogradouros = [
                'Rua',
                'Avenida',
                'Praça',
                'Travessa'
            ];
            return view('administracao.endereco.dados', compact('cep', 'tiposLogradouros'));
        }
    }

    public function store(Request $request)
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
            return view('administracao.instituicao.dados', compact('endereco'));
        } catch (Exception $e) {
            redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }

    }
}
