<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware($this->guestMiddleware());
    }

    public function alterarSenha(Request $request)
    {
        $this->validate(
            $request,
            $this->getResetRules()
        );

        $user = User::find($request->input('user-id'));

        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Session::flash(self::getTipoSucesso(), self::getMsgAlteracao());
        return redirect()->back();
    }

    private function getResetRules()
    {
        return [
            '_token' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
