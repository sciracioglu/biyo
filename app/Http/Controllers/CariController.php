<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CariFormGonder;

class CariController extends Controller
{
    private $cari;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->cari =   DB::select('EXEC [dbo].[spArgWebCariEkstre] ?', [session('musteri.hesapkod')]);

            return $next($request);
        });
    }

    /**
    * @return \Illuminate\View\View
    */
    public function index()
    {
        $cari = $this->cari;

        return view('cari', compact('cari'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new CariFormGonder($this->cari));
        }

        return back();
    }
}
