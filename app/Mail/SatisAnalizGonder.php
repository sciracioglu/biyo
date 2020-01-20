<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SatisAnalizGonder extends Mailable
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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('satis_analiz_tablo');
    }
}
