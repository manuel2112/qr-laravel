<?php

namespace App\Mail;

use App\Models\Empresa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $mensaje;
    public $empresa;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensaje)
    {
        $this->empresa = Empresa::where('user_id',auth()->user()->id)->first();
        $this->subject = $subject;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contacto', [
            'mensaje'   => $this->mensaje,
            'empresa'   => $this->empresa
        ]);
    }
}
