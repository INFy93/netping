<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $netping;
    public $state;
    public $time;
    public $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $netping, $state, $time, $date)
    {
        $this->user = $user;
        $this->netping = $netping;
        $this->state = $state;
        $this->time = $time;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Точка '.$this->netping.' '.mb_strtolower($this->state))
        ->view('mail.mail');
    }
}
