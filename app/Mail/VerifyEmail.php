<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email_data;

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
            return $this->from(env('MAIL_USERNAME'), 'Mystery register successful')
            ->subject('Email Approved')
            ->view('mails.verified', ['email_data' => $data]);
        }else{
            return $this->from(env('MAIL_USERNAME'), 'Mystery register successful')
            ->subject('Xác nhận đăng ký')
            ->view('mails.verified', ['email_data' => $data]);
        }
     
    }
}
