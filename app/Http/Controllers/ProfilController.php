<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil');
    }

    public function store()
    {
        $sifre = request()->validate([
            'password' => 'required|confirmed'
        ]);
        DB::select('EXEC ArgWebPaswdChangeProc(?,?)', [session('username'), $sifre['password']]);

        return back()->with('info', 'sifreniz degisti');
    }
}
