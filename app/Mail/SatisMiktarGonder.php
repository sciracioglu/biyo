<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SatisMiktarGonder extends Mailable
{
    public $yillar;
    public $analiz;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($yillar, $analiz)
    {
        $this->yillar = $yillar;
        $this->analiz = $analiz;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('satis_miktar_tablo');
    }
}
