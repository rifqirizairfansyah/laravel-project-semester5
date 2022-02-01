<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $fullname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($username, $fullname)
    {
        //
        $this->username = $username;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mail')
            ->subject("Konfirmasi Email | Bibit")
            ->view('emails.mail');
    }
}
