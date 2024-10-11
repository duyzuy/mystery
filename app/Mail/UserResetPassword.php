<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPassword extends Mailable
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
            ->subject('Reset password')
            ->view('mails.en.userresetpassword', ['email_data' => $data]);
        }else{
            return $this->from(env('MAIL_USERNAME'), 'Mystery Diner')
            ->subject('Đặt lại mật khẩu')
            ->view('mails.vi.userresetpassword', ['email_data' => $data]);
        }

    }
}
