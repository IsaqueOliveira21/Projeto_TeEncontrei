<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function formLogin(): View|Factory|Application
    {
        return view('login');
    }

    /**
     * @throws Exception
     */
    public function postLogin(Request $request): View|Factory|RedirectResponse|Application
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('administracao.restrita');
            } else {
                // return $this->formLogin();
                return view('login', ['mensagem' => 'Login ou Senha invalidos!']);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    /**
     * @return RedirectResponse
     */
    public function naoAutorizado(): RedirectResponse
    {
        //dd('Não Autorizado!');
        return redirect()->route('user.login');
    }

    /**
     * @return Application|Factory|View
     */
    public function administracaoRestrita(): View|Factory|Application
    {
        return view('administracao.restrita');
    }
}
