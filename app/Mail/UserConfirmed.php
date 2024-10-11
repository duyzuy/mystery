<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirmed extends Mailable
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
            ->subject('Mystery Diner Reservation')
            ->view('mails.en.userfinalconfirmed', ['email_data' => $data]);
        }else{
            return $this->from(env('MAIL_USERNAME'), 'Mystery Diner')
            ->subject('Xác nhận lịch khảo sát')
            ->view('mails.vi.userfinalconfirmed', ['email_data' => $data]);
        }
      
    }
}
