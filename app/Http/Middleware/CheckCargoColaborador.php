<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCargoColaborador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        # if(Auth::user()->colaborador->cargo == 'ADMINISTRADOR')
        if(!in_array(Auth::user()->colaborador->cargo, ['ADMINISTRADOR', 'TI']))
        {
            return redirect()->route('colaborador.index')->with(['tipo' => 'warning', 'mensagem' => 'Você não tem permissão para esse acesso!']);
        }
        return $next($request);
    }
}
