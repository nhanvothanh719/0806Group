<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotifyComment extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $idea;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$idea,$data)
    {
        $this->user = $user;
        $this->idea = $idea;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(ENV('MAIL_USERNAME'))
        ->subject('Mail from GCD0806Group app')
        ->view('emails.mail-notify-new-comment');
    }
}
