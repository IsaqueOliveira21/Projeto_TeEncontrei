<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Desabrigado;
use App\Models\VisitaCabecalho;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class VisitaController extends Controller
{
    private $visita;

    public function __construct(VisitaCabecalho $visita)
    {
        $this->visita = $visita;
    }

    public function index(Request $request)
    {
        $desabrigados = Desabrigado::orderBy('nome')->get();
        if (!empty($request->datas)) {
            $datas = explode(' to ', $request->datas);
        } else {
            $datas = [
                0 => null,
                1 => null,
            ];
        }

        $queryVisitas = $this->visita
            ->where('instituicao_id', Auth::user()->colaborador->instituicao_id);
        if (!empty($request->datas)) {
            $queryVisitas->whereBetween('created_at', [$datas[0], $datas[1]]);
        }
        if (!empty($request->desabrigado_id)) {
            $queryVisitas->where('desabrigado_id', $request->desabrigado_id);
        }
        $visitas = $queryVisitas->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('instituicao.visita.index', compact('visitas', 'desabrigados'));
    }
}
