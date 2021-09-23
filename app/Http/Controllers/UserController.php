<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
use App\Actions\Jetstream\DeleteUser;

class UserController extends Controller
{
     /** Dados do Usuário */
     public function profile() {
        $user = auth()->user();

        $userName = $user->name;
        $email = $user->email;
        $pass = $user->password;
        $createdAt = $user->created_at;

        return view('expenses.profile', [
                                        'userName' => $userName,
                                        'email' => $email,
                                        'pass' => $pass,
                                        'createdAt' => $createdAt
                                        ]);
    }

    /** Alterando o nome */
    public function nameUpdate(Request $request) {
        
        $user = auth()->user();
        $newName = $request->name;

        if (strlen($newName) < 3) {
            return redirect('/expenses/profile')->with('fail', 'O nome precisa conter mais que 3 caracteres!');
        } else {

            /** Forçando o preenchimento do campo de nome no banco
            */            
            $user->forceFill([
                'name' => $newName
            ])->save();

            /** Redirecionando */          
            return redirect('/expenses/profile')->with('success', 'Nome alterado com sucesso!');
        } 
    }

    /** Alterando a senha */
    public function passwordUpdate(Request $request) {
        
        $user = auth()->user();
        $data = $request->all();

        if (strlen($data['passwordNew']) < 8) {
            return redirect('/expenses/profile')->with('fail', 'A nova senha precisa conter mais que 8 caracteres!');
        } elseif ($data['passwordNew'] != $data['passwordConfirm']) {
            return redirect('/expenses/profile')->with('fail', 'As senhas não correspondem.');
        } 

        /** Verifica se a senha atual passada corresponde com a já cadastrada 
         * Verificando se a nova senha e confirmação são iguais
        */
        if (password_verify($data['password'], $user->password)) {

            /** Criptogragando a nova senha usando o Hash do Facades
             *  Forçando o preenchimento do campo de senha no banco
            */            
            $user->forceFill([
                'password' => Hash::make($data['passwordNew'])
            ])->save();

            /** Redirecionando */          
            return redirect('/expenses/profile')->with('success', 'Senha alterada com sucesso!');
        } else {
            return redirect('/expenses/profile')->with('fail', 'A Corrija a senha atual.');
        }
    }

    public function destroyUser(Request $request)
    {   
        $user = auth()->user();
        $data = $request->all();

        if (password_verify($data['password'], $user->password)) {
            User::findOrFail($user->id)->delete();
            return redirect('/');
        } else {
            return redirect('/expenses/profile')->with('fail', 'Senha incorreta.');
        }
    }

}
