<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KapatmaController extends Controller
{
    private $yetkililer = [
        'Ayla Kurucu',
        'Onurcan Kurucu',
        'Nadir Kurucu',
        'Dogacan Kurucu',
        'Yıldız Ay',
        'Mehmet Ay'
    ];

    public function index()
    {
        if (!in_array(session('username'), $this->yetkililer)) {
            return '';
        }
        $borclar = collect(DB::select('exec [dbo].[ArgWebKapamaProc] ?', [session('musteri.hesapkod')]));
        $borc_ortalama = collect(DB::select('exec [dbo].[ArgWebKapamaProcOrt] ?', [session('musteri.hesapkod')]));

        $alacaklar = collect(DB::select('exec [dbo].[ArgWebKapamaProcAlacak] ?', [session('musteri.hesapkod')]));
        $alacak_ortalama = collect(DB::select('exec [dbo].[ArgWebKapamaProcAlacakOrt] ?', [session('musteri.hesapkod')]));

        return view('kapatma', compact('borclar', 'alacaklar', 'borc_ortalama', 'alacak_ortalama'));
    }
}
