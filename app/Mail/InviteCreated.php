<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use \Illuminate\Contracts\Mail\Mailable as Contract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteCreated extends Mailable implements Contract
{
    use Queueable, SerializesModels;

    protected $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.invite', compact('invite'));
    }
}
