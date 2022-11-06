<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Endereco;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ColaboradorController extends Controller
{
    private $cargos = [
        'ATENDENTE',
        'EQUIPE APOIO',
        'COZINHEIRO',
        'ASG',
        'SEGURANÇA',
        'ENFERMEIRO',
        'SECRETARIA',
        'ADMINISTRADOR',
        'TI'];

    public function index(Request $request)
    {
        $colaboradores = DB::table('colaboradores')
            ->join('users', 'colaboradores.user_id', '=', 'users.id')
            ->select('colaboradores.id', 'users.name', 'users.last_name', 'colaboradores.cargo', 'colaboradores.ativo', 'colaboradores.created_at')
            ->where('colaboradores.instituicao_id', Auth::user()->colaborador->instituicao_id)
            ->orderBy('users.name')
            ->paginate(10);
        return view('instituicao.colaborador.index', compact('colaboradores'));
    }

    public function buscarEndereco(Colaborador $colaborador = null)
    {
        return view('instituicao.colaborador.busca_endereco', compact('colaborador'));
    }

    public function buscarEnderecoPost(Colaborador $colaborador = null, Request $request)
    {
        $endereco = Endereco::where('cep', $request->cep)->first();
        if ($endereco) {
            $cargos = $this->cargos;
            if(is_null($colaborador)) {
                return view('instituicao.colaborador.dados', compact('endereco', 'cargos'));
            } else {
                return view('instituicao.colaborador.dados', compact(['endereco', 'cargos', 'colaborador']));
            }
        } else {
            $cep = $request->cep;
            $tiposLogradouros = [
                'Rua',
                'Avenida',
                'Praça',
                'Travessa'
            ];
            if(is_null($colaborador)) {
                return view('instituicao.colaborador.endereco', compact(['cep', 'tiposLogradouros',]));
            } else {
                return view('instituicao.colaborador.endereco', compact(['cep', 'tiposLogradouros', 'colaborador']));
            }
        }
    }

    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $nomeFoto = $request->hasFile('photo') ? (new UserController)->uploadPhoto($request->photo) : null;
            if ($request->password != $request->confirm_password) {
                return redirect()->back()->with(['tipo' => 'warning', 'mensagem' => 'As senhas não conferem']);
            } else {
                DB::beginTransaction();
                try {
                    $user = User::create([
                        'name' => $request->name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'photo' => $nomeFoto,
                    ]);
                    $user->colaborador()->create([
                        'instituicao_id' => Auth::user()->colaborador->instituicao_id,
                        'endereco_id' => $request->endereco_id,
                        'numero_endereco' => $request->numero_endereco,
                        'cargo' => $request->cargo,
                        'data_nascimento' => Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d'),
                    ]);
                    /*Colaborador::create([
                        'instituicao_id' => Auth::user()->colaborador->instituicao_id,
                        'user_id' => $user->id,
                        'endereco_id' => $request->endereco_id,
                        'numero_endereco' => $request->numero_endereco,
                        'cargo' => $request->cargo,
                        'data_nascimento' => Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d'),
                    ]);*/
                    DB::commit();
                    return redirect()->route('colaborador.index')->with(['tipo' => 'success', 'mensagem' => 'Colaborador cadastrado com sucesso!']);
                } catch (Exception $e) {
                    DB::rollBack();
                    return redirect()->route('colaborador.index')->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
                }
            }
        }
    }

    public function buscarEnderecoStore(Colaborador $colaborador = null, Request $request)
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
            $cargos = $this->cargos;
            if(is_null($colaborador)){
                return view('instituicao.colaborador.dados', compact('endereco', 'cargos'));
            } else {
                return view('instituicao.colaborador.dados', compact(['endereco', 'cargos', 'colaborador']));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            redirect()->back()->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
        }
    }

    public function edit(Colaborador $colaborador)
    {
        $cargos = $this->cargos;
        $endereco = $colaborador->endereco;
        return view('instituicao.colaborador.dados', compact(['endereco', 'cargos', 'colaborador']));
    }

    public function update(Colaborador $colaborador, Request $request)
    {
        if ($request->hasFile('photo')) {
            File::delete(storage_path('app/public/photos/'.$colaborador->user->photo));
            $nomeFoto = (new UserController)->uploadPhoto($request->photo);
        } else {
            $nomeFoto = $colaborador->user->photo;
        }
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->with(['tipo' => 'warning', 'mensagem' => 'As senhas não conferem']);
        } else {
            DB::beginTransaction();
            try {
                $colaborador->user->name = $request->name;
                $colaborador->user->last_name = $request->last_name;
                $colaborador->user->email = $request->email;
                $colaborador->user->password = bcrypt($request->password);
                $colaborador->user->photo = $nomeFoto;
                $colaborador->user->save();
                $colaborador->cargo = $request->cargo;
                $colaborador->numero_endereco = $request->numero_endereco;
                $colaborador->data_nascimento = Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d');
                $colaborador->save();
                DB::commit();
                return redirect()->route('colaborador.edit', $colaborador)->with(['tipo' => 'success', 'mensagem' => 'Colaborador atualizado com sucesso!']);
            } catch(Exception $e) {
                DB::rollback();
                return redirect()->route('colaborador.edit', $colaborador)->with(['tipo' => 'danger', 'mensagem' => $e->getMessage()]);
            }
        }
    }
}
