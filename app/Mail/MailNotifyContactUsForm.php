<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotifyContactUsForm extends Mailable
{
    use Queueable, SerializesModels;
    public $receiver;
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiver, $contact)
    {
        $this->receiver = $receiver;
        $this->contact = $contact;
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
        ->view('emails.contact_email');
    }
}
