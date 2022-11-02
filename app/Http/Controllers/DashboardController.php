<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        return view('instituicao.dashboard');
    }
}
