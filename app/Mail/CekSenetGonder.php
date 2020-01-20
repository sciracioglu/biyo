<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CekSenetGonder extends Mailable
{
    public $cek_senet;
    public $detay;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cek_senet, $detay)
    {
        $cekSenet = $this->cek_senet;
        $detay    = $this->detay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('cek_tablo');
    }
}
