<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RiskGonder extends Mailable
{
    public $bakiye;
    public $bakiye_bakiye;
    public $bakiye_tip;
    public $ust_bakiye;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bakiye, $bakiye_bakiye, $bakiye_tip, $ust_bakiye)
    {
        $this->bakiye        = $bakiye;
        $this->bakiye_bakiye = $bakiye_bakiye;
        $this->bakiye_tip    = $bakiye_tip;
        $this->ust_bakiye    = $ust_bakiye;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('risk_tablo');
    }
}
