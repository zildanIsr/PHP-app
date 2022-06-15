<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function daftar(){
        return view('daftar');
    }
    public function simpanuser(Request $req){
        $user = User::create([
            'nama' => $req-> nama,
            'email' => $req-> email,
            'password' => bcrypt($req-> password)
        ]);
        
        return redirect('/');
    }

    public function login(){
        return view('login');
    }

    public function cekmasuk(Request $req){
        
        if (!Auth::attempt([
            'email' => $req->email,
            'password' => $req->password
        ])){
            
            return redirect('/');
        }
        else{
            $blog = DB::table('users')->where('email', $req->email)->first();
                    
            
            return redirect('/home');
        }
    }
}
