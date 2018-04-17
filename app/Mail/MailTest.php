<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class MailTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.mailTp');
            /* Để đính kèm 1 tập tin trong mail ta sử dụng phương thức attach. Tham số truyền vào là đường dẫn đến file cần đính kèm. */
        return $this->view('emails.orders.shipped')
        ->attach('/path/to/file.pdf');


    }

}
