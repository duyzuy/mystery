<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseCompleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $email_data;
    public function __construct($data)
    {
        //
        $this->email_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->email_data;
        if($data['locale'] == 'en'){
            return $this->from(env('MAIL_USERNAME'), 'Mystery Diner')
            ->subject('Complete the Mystery Diner form')
            ->view('mails.en.completed-survey', ['email_data' => $data]);
        }else{
            return $this->from(env('MAIL_USERNAME'), 'Mystery Diner')
            ->subject('Hoàn thành khảo sát')
            ->view('mails.vi.completed-survey', ['email_data' => $data]);
        }
       
    }
}
