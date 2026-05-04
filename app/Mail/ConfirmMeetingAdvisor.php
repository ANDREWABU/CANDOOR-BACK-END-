<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMeetingAdvisor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $detailsAdvisor;
    public function __construct($detailsAdvisor)
    {
        //
        $this->detailsAdvisor = $detailsAdvisor;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject('Confirmed: '.$this->detailsAdvisor['advisee_name'].' & '.$this->detailsAdvisor['advisor_name'].'')
            ->view('Mail.confirmMeetingAdvisor')
            ->from('support@candoor.io');
    }
}
