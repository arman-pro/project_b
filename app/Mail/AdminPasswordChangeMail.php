<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPasswordChangeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $temp = null;
    public $email = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($temp)
    {
        $this->temp = $temp['temp'];
        $this->email = $temp['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.auth.reset');
    }
}
