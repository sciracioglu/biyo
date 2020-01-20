<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CariFormGonder extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $cari;

    public function __construct($cari)
    {
        $this->cari = $cari;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('cari_tablo');
    }
}
