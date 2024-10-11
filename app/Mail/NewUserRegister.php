<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserRegister extends Mailable
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
                    ->subject('Registered successful')
                    ->view('mails.en.newuser', ['email_data' => $data])
                    ->attach($data['file'], array(
                        'mime'  =>  'application/pdf'
                    ));
        }else{
            return $this->from(env('MAIL_USERNAME'), 'Mystery Diner')
                ->subject('Đăng ký thành công')
                ->view('mails.vi.newuser', ['email_data' => $data])
                ->attach($data['file'], array(
                    'mime'  =>  'application/pdf'
                ));
        }
    }
}
