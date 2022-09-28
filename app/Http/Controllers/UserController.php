<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param String $email
     * @param String $password
     * @return string
     */
    public function login(string $email, string $password): string
    {
        return "E-mail: $email ; Password: $password";
    }


    /**
     * @param Request $request
     * @return User
     * @throws Exception
     */
    public function store(Request $request): User
    {
        $password = !is_null($request->password) ? bcrypt($request->password) : bcrypt('senha');
        try {
            $request->validate(
                [
                    'name' => 'required|min:1|string',
                    'last_name' => 'required|min:1|string',
                    'email' => 'required|unique:users|email',
                    'password' => 'nullable|string|max:12'
                ]
            );
            // dd($validacao);
            return User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            /* $user = new User();
             $user->name = $request->name;
             $user->last_name = $request->last_name;
             $user->email = $request->email;
             $user->password = $password;
             $user->save();
             return $user; */
        } catch (Exception $e) {
            throw new Exception("{$e->getMessage()}, {$e->getLine()}}");
        }
    }

    public function update(User $user, Request $request): User
    {
        try {
            $request->validate(
                [
                    'name' => 'required|min:1|string',
                    'last_name' => 'required|min:1|string',
                    'email' => 'required|unique:users|email',
                    'password' => 'nullable|string|max:12'
                ]
            );
            $password = !is_null($request->password) ? bcrypt($request->password) : bcrypt('senha');
            //$user = User::findOrFail($id);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = $password;
            $user->save();
            return $user;
        } catch (Exception $e) {
            throw new Exception("{$e->getMessage()}, {$e->getLine()}}");
        }

    }
}
