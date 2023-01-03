<?php

namespace App\Jobs;

use App\Mail\MailNotifyContactUsForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailContactUs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $contact;
    protected $receivers;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact, $receivers)
    {
        //
        $this->contact = $contact;
        $this->receivers = $receivers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->receivers as $receiver) {
            Mail::to($receiver->email)->send(new MailNotifyContactUsForm($receiver, $this->contact));
        }
    }
}
