<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forgetpassword extends Mailable
{
    use Queueable, SerializesModels;
    public $details = null;
    public $user = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $user)
    {
        //
        $this->details = $details;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset')->view('mail.reset-password');
    }
}
