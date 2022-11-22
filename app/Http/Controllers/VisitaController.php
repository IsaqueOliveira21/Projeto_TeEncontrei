<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Desabrigado;
use App\Models\VisitaCabecalho;
use App\Models\VisitaDetalhe;
use Exception;
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

    public function create(Desabrigado $desabrigado = null, Request $request)
    {
        if(isset($desabrigado->id)){
            $dadosDesabrigado = [
                $desabrigado->id,
                $desabrigado->nome.' '.$desabrigado->sobrenome
            ];
        } else {
            $dadosDesabrigado = null;
        }

        $desabrigados = Desabrigado::orderBy('nome')->get();
        return view('instituicao.visita.dados', compact('desabrigados', 'dadosDesabrigado'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $cabecalho = $this->visita->create([
                'instituicao_id' => Auth::user()->colaborador->instituicao_id,
                'desabrigado_id' => $request->desabrigado_id,

            ]);
            $cabecalho->detalhes()->create([
                'colaborador_id' => Auth::user()->colaborador->id,
                'tipo' => $request->tipo,
            ]);
            DB::commit();
            return redirect()->route('visita.index')->with(['tipo' => 'success', 'mensagem' => 'Visita cadastrada com sucesso!']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function edit(VisitaCabecalho $visitaCabecalho)
    {
        $desabrigados = Desabrigado::orderBy('nome')->get();
        return view('instituicao.visita.dados', compact('visitaCabecalho', 'desabrigados'));
    }

    public function update(VisitaCabecalho $visitaCabecalho, Request $request)
    {
        DB::beginTransaction();
        try {
            $visitaCabecalho->desabrigado_id = $request->desabrigado_id;
            $visitaCabecalho->save();
            if(!is_null($request->tipo)) {
                $tipos = [];
                foreach($visitaCabecalho->detalhes as $detalhe) {
                    $tipos[] = $detalhe->tipo;
                }
                if(!in_array($request->tipo, $tipos)){
                    $visitaCabecalho->detalhes()->create([
                        'colaborador_id' => Auth::user()->colaborador->id,
                        'tipo' => $request->tipo,
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Visita atualizada com sucesso!']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function deleteDetalhe(Request $request)
    {
        $detalhe = VisitaDetalhe::find($request->id);
        $detalhe->delete();
        return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Evento excluído com sucesso!']);
    }
}
