<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Winner extends Mailable
{
    use Queueable, SerializesModels;

    public $lot;
    public $username;
    public $bid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $lot, $bid)
    {
        $this->lot = $lot;
        $this->username = $username;   
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.winner');
    }
}
