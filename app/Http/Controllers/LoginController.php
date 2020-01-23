<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store()
    {
        $data = request()->validate([
            'sifre'     => 'required',
            'kullanici' => 'required'
        ]);
        $kullanicilar = DB::select('select dbo.CheckPassword(?,WEBPASSWORD) AS SAYI FROM  vwwusr WHERE USERNAME =?', [
            request('sifre'),
            request('kullanici')
        ]);

        if (!$kullanicilar) {
            return redirect('login')->with('warning', 'Hatali bilgi girdiniz!');
        }

        $eposta = DB::select('SELECT EMAIL FROM vwwusr WHERE USERNAME	 =?', [
            request('kullanici')
        ]);

        $tip = DB::select("SELECT KOD, SUBSTRING( dbo.refkrt.ACIKLAMA,5,100) ACIKLAMA FROM refkrt
							WHERE dbo.refkrt.ALANAD	='EVRAKTIP' AND dbo.refkrt.TABLOAD	='EVRBAS'");
        $evraktip = [];
        foreach ($tip as $t) {
            $evraktip[$t->KOD] = $t->ACIKLAMA;
        }
        session()->put('evraktip', $evraktip);

        foreach ($kullanicilar as $k) {
            if ($k->SAYI == 1) {
                session()->put('username', request('kullanici'));
                return redirect('/');
            }
        }

        return redirect('login')->with('warning', 'Hatalı bilgi girdiniz!');
    }

    public function destroy($username)
    {
        session()->flush();
        Cookie::queue(
			Cookie::forget('Laravel')
		);
        return redirect('/login');
    }
}
