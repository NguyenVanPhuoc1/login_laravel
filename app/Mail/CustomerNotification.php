<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CustomerNotification extends Mailable
{
    public $messageContent;

    // Constructor nhận thông báo
    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    // Định nghĩa cách xây dựng email
    public function build()
    {
        return $this->view('emails.notification')
                    ->with('messageContent', $this->messageContent)
                    ->subject('Customer Notification');
    }
}
