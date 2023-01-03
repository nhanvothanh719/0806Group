<?php

namespace App\Jobs;

use App\Mail\MailNotifyCreateUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailCreateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $new_user;
    protected $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($new_user,$password)
    {
        $this->new_user = $new_user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $new_user = $this->new_user;
        Mail::to($new_user->email)->send(new MailNotifyCreateUser($new_user, $this->password));
    }
}
