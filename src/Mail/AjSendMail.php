<?php

namespace Ajency\Ajfileimport\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use View;

class AjSendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $params;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params = array())
    {
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        if (isset($params['attachment'])) {
            return $this->view('AjcsvimportView::importlogs')->attach($this->params['attachment']);
        } else {
            return $this->view('AjcsvimportView::importlogs');
        }

    }
}
