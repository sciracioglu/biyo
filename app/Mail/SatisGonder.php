<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SatisGonder extends Mailable
{
    public $grup;
    public $detay;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($grup, $detay)
    {
        $this->grup  = $grup;
        $this->detay = $detay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('satis_tablo');
    }
}
