<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Hareket;

class SiparisController extends Controller
{
    public function index()
    {
        if (request()->has('serino')) {
            return collect(DB::select('exec [dbo].[ARG_WEB_LOTNO_ARAMA] ?, ?', [session('username'), request('serino')]));
        }
    }

    public function create()
    {
        $data['satiscilar'] = collect(DB::select('SELECT TEMSILCINO,ACIKLAMA1 FROM CRMTMK'));
        $data['takipler']   = collect(DB::select("SELECT KOD, ACIKLAMA FROM REFKRT WHERE TABLOAD='CRMFRK' AND ALANAD = 'BKOD1'"));
        $data['ihaleler']   = collect(DB::select("SELECT KOD, ACIKLAMA FROM REFKRT WHERE TABLOAD = 'CRMFRK' AND ALANAD='SKOD2'"));
        $evrak_no           = DB::select('EXEC [dbo].[spArgSipGetEvrakNo]');
        $data['evrak_no']   = $evrak_no[0]->EVRAKNO;
        return view('siparis', $data);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'satis_sekli'   => 'required',
            'hastane'       => 'required',
            'hasta'         => 'required',
            'serino'        => 'required',
            'evrak_no'      => 'required'
        ]);

        $this->evrakBaslikKaydet($data);
        $this->kalemKaydet($data);
    }

    public function show($evrak_no)
    {
        return DB::select('SELECT KALEMSN,EVRAKNO,MALKOD,(SELECT MALAD FROM STKKRT WHERE MALKOD= STKHAR.MALKOD) AS MALAD,SERINO,SERINO2 AS LOT,TARIH2 AS SKT,FIYAT,(SELECT BARKOD1 FROM STKKRT WHERE MALKOD= STKHAR.MALKOD) AS UBB FROM STKHAR WHERE EVRAKNO = ?', [$evrak_no]);
    }

    private function evrakBaslikKaydet($data)
    {
        DB::insert('EXEC [dbo].[SpArgSipInsEvrBas] ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ', [
            session('musteri.hesapkod'),
            $data['satis_sekli'],
            $data['hastane'],
            (request()->has('doktor') && request('doktor') != null) ? request('doktor') : '',
            $data['hasta'],
            (request()->has('kimlikno') && request('kimlikno') != null) ? request('kimlikno') : '',
            (request()->has('protokol') && request('protokol') != null) ? request('protokol') : '',
            (request()->has('aciklama') && request('aciklama') != null) ? request('aciklama') : '',
            session('username'),
            $data['evrak_no']
        ]);
    }

    private function kalemKaydet($data)
    {
        DB::connection('sqlsrv')->statement('SET ANSI_NULLS, QUOTED_IDENTIFIER, CONCAT_NULL_YIELDS_NULL, ANSI_WARNINGS, ANSI_PADDING ON');
        DB::connection('sqlsrv')->insert('EXEC [dbo].[spArgSipInsStkHar] ?, ?, ?, ?, ?, ?, ?, ?', [
            $data['evrak_no'],
            $data['serino'],
            session('username'),
            request('serino2'),
            request('skt'),
            request('ubb'),
            request('tarihi'),
            request('depokod')
        ]);
    }

    public function destroy($kalem)
    {
        DB::connection('sqlsrv')->statement('SET ANSI_NULLS, QUOTED_IDENTIFIER, CONCAT_NULL_YIELDS_NULL, ANSI_WARNINGS, ANSI_PADDING ON');
        Hareket::where('KALEMSN', $kalem)->delete();
    }
}
