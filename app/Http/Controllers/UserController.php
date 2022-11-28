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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
                if(Auth::user()->colaborador()->count() == 0) {
                    return redirect()->route('administracao.dashboard');
                } else {
                    if(Auth::user()->colaborador->ativo){
                        return redirect()->route('instituicao.dashboard');
                    } else {
                        return view('login', ['mensagem' => 'Usuario desativado!']);
                    }
                }
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $users = User::where('name', 'LIKE', "%{$request->pesquisa}%")
            ->orWhere('last_name', 'LIKE', "%{$request->pesquisa}%")
            ->orderBy('name')->paginate(12);
        return view('administracao.user.index', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('administracao.user.dados');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // User::create(['name' => $request->name, 'last_name' => $request->last_name, 'email' => $request->email, 'password' => bcrypt('acheiaqui123')]);
            $user = new User();
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt('acheiaqui123');
            $user->save();
            return redirect()->route('user.index')->with(['tipo' => 'success', 'mensagem' => 'Novo usuário cadastrado com sucesso']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }

    }

    /**
     * @param User|null $user
     * @return Application|Factory|View
     */
    public function edit(User $user = null): View|Factory|Application
    {
        if (is_null($user)) {
            return view('administracao.user.perfil');
        } else {
            return view('administracao.user.dados', compact('user'));
        }
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        if (is_null($user->id)) {
            // dd(Auth::user());
            $user = Auth::user();
            if ($request->hasFile('photo')) {
                File::delete(storage_path('app/public/photos/'.$user->photo));
                $nomeFoto = $this->uploadPhoto($request->photo);
            } else {
                $nomeFoto = null;
            }
            // if (bcrypt($request->current_password) == $user->password) {
            if ($request->password != $request->confirm_password) {
                return redirect()->back()->with(['tipo' => 'warning', 'mensagem' => 'As senhas não conferem']);
            } else {
                DB::beginTransaction(); // <- Só precisa disso caso haja mais de um tipo de operação
                try {
                    // dd($user);
                    $user->name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    if (!is_null($nomeFoto)) {
                        $user->photo = $nomeFoto;
                    }
                    $user->save();
                    DB::commit();
                    return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Seus dados foram atualizados com sucesso']);
                } catch (Exception $e) {
                    DB::rollback();
                    return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
                }
            }
            // } else {
            // return redirect()->back()->with(['tipo' => 'warning', 'mensagem' => 'Senha Atual não confere']);
            // }
        } else {
            if ($request->hasFile('photo')) {
                File::delete(storage_path('app/public/photos/'.$user->photo));
                $nomeFoto = $this->uploadPhoto($request->photo);
            } else {
                $nomeFoto = null;
            }
            try {
                $user->name = $request->name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->photo = $nomeFoto;
                $user->save();
                return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Os dados do usuário foram atualizados com sucesso']);
            } catch (Exception $e) {
                return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
            }
        }
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function redefinirSenha(User $user): RedirectResponse
    {
        try {
            $user->password = bcrypt('teencontrei123');
            $user->save();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Senha do usuário redefinidia para "teencontrei123"']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $user = User::find($request->id);
        try {
            $user->delete();
            return redirect()->back()->with(['tipo' => 'success', 'mensagem' => 'Usuário removido com sucesso']);
        } catch (Exception $e) {
            return redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }

    }

    /**
     * @param $photo
     * @return string
     */
    public function uploadPhoto($photo): string
    {
        $nome = uniqid(time()) . '.' . $photo->getClientOriginalExtension();
        $caminho = storage_path('app/public/photos/' . $nome);
        Image::make($photo->getRealPath())->resize(250, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($caminho);
        return $nome;
    }
}
