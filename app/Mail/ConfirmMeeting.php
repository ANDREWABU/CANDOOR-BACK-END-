<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMeeting extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $detailsAdvisee;
    public function __construct($detailsAdvisee)
    {
        //
        $this->detailsAdvisee = $detailsAdvisee;
     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmed: '.$this->detailsAdvisee['advisee_name'].' & '.$this->detailsAdvisee['advisor_name'].'')
            ->view('Mail.confirmMeeting')
            ->from('support@candoor.io');
    }
}
