<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class GecikenBakiyeGonder extends Mailable
{
    public $geciken;
    public $detay;
    public $evr_tip;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($geciken, $detay, $evr_tip)
    {
        $this->geciken = $geciken;
        $this->detay   = $detay;
        $this->evr_tip = $evr_tip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('geciken_tablo');
    }
}
