<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function administracao(): View|Factory|Application
    {
        return view('administracao.dashboard');
    }

    /**
     * @return Application|Factory|View
     */
    public function instituicao(): View|Factory|Application
    {
        $graficos = [];

        $graficos['grafico1']['SEMANA ATUAL'] = DB::table('visitas_cabecalhos')
            ->whereRaw('created_at BETWEEN DATE(DATE_SUB(NOW(), INTERVAL 1 WEEK)) AND DATE(NOW())')
            ->where('instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->count();
        $graficos['grafico1']['SEMANA ANTERIOR'] = DB::table('visitas_cabecalhos')
            ->whereRaw('created_at BETWEEN DATE(DATE_SUB(NOW(), INTERVAL 2 WEEK)) AND DATE(DATE_SUB(NOW(), INTERVAL 1 WEEK))')
            ->where('instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->count();

        $queryDocumentacaoIncompleta = DB::table('desabrigados')
            ->join('visitas_cabecalhos', 'visitas_cabecalhos.desabrigado_id', '=', 'desabrigados.id')
            ->where('instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->where(function($query) {
                $query->orWhereNull('certidao_nascimento')
                    ->orWhereNull('cartao_sus')
                    ->orWhereNull('rg')
                    ->orWhereNull('cpf');
            })
            ->count();

        $queryDocumentacaoCompleta = DB::table('desabrigados')
            ->join('visitas_cabecalhos', 'visitas_cabecalhos.desabrigado_id', '=', 'desabrigados.id')
            ->where('instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->whereNotNull('certidao_nascimento')
            ->whereNotNull('cartao_sus')
            ->whereNotNull('rg')
            ->whereNotNull('cpf')
            ->count();

        $total = $queryDocumentacaoIncompleta + $queryDocumentacaoCompleta;
        $graficos['graficos2']['DOCUMENTAÇÃO INCOMPLETA'] = $queryDocumentacaoIncompleta * 100 / $total;
        $graficos['graficos2']['DOCUMENTAÇÃO COMPLETA'] = $queryDocumentacaoCompleta * 100 / $total;

        $meses = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro',
        ];
        $queryQtdUltimoAno = DB::table('visitas_cabecalhos')
            ->selectRaw('MONTH(created_at) AS mes, COUNT(*) AS qtd')
            ->where('instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->whereRaw('created_at BETWEEN DATE(DATE_SUB(NOW(), INTERVAL 1 YEAR)) AND DATE(NOW())')
            ->groupBy('mes')
            ->get();
        foreach($queryQtdUltimoAno as $linha) {
            $graficos['grafico3'][$meses[$linha->mes - 1]] = $linha->qtd;
        }
        return view('instituicao.dashboard.index', compact('graficos'));
    }
}
