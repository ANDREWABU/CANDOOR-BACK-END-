<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RescheduleMeeting extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $details;
    public function __construct($details)
    {
        //
        $this->details = $details;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        
        return $this->subject('New Time Proposed: '.$this->details['send_usr_mail'].' & '.$this->details['currentUser_first_name'].'')
            ->view('Mail.rescheduleMeeting')
            ->from('support@candoor.io');
    }
}
