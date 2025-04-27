<?php

namespace App\Http\Controllers;
//práca s autentifikáciou
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    { // beriem iba email a heslo
        $credentials = $request->only('email', 'password');
        // attempt overuje ci existuje v db pouzivatel s danym mailom a heslom
        if (Auth::attempt($credentials)) {
            //vytvara UID pre session Staré ID session, ktoré bolo uložené v cookie prehliadača 
            // používateľa, sa nahradí týmto novým ID
            $request->session()->regenerate();
            //presmeruje podla toho kam sa chcel pred prihlasenim dostat
            return redirect()->intended('/admin/posts'); 
        }
        //ak attempt() zlyha, presmeruje naspat a prida chybovu hlasku
        return back()->withErrors([
            'email' => 'Neplatné prihlasovacie údaje.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        //zneplatni session
        $request->session()->invalidate();
        //regeneruje csrf
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}