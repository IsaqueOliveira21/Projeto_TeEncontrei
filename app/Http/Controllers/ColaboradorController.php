<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function index(Request $request)
    {
        $colaboradores = Colaborador::join('users', 'colaboradores.user_id', '=', 'users.id')
            ->where('name', 'LIKE', "%{$request->pesquisa}%")
            ->orWhere('last_name', 'LIKE', "%{$request->pesquisa}%")
            ->orderBy('name')
            ->paginate(10);
        return view('instituicao.colaborador.index', compact('colaboradores'));
    }
}
