<?php

namespace App\Jobs;

use App\Mail\MailNotifyComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailNewComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $idea;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $user, $idea)
    {
        $this->data = $data;
        $this->idea = $idea;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new MailNotifyComment($this->user['name'],$this->idea['title'],$this->data['content']));
    }
}
