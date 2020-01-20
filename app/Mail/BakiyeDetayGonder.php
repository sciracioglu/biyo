<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class BakiyeDetayGonder extends Mailable
{
    public $geciken;
    public $evr_tip;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($geciken, $evr_tip)
    {
        $this->geciken = $geciken;
        $this->evr_tip = $evr_tip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('detay_tablo');
    }
}
