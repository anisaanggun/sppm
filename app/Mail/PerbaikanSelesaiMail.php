<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PerbaikanSelesaiMail extends Mailable
{
    public $pelanggan;

    /**
     * Create a new message instance.
     *
     * @param $pelanggan
     * @return void
     */
    public function __construct($pelanggan)
    {
        $this->pelanggan = $pelanggan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Perbaikan Mesin Selesai')
            ->view('emails.perbaikan_selesai')
            ->with([
            'pelanggan' => $this->pelanggan,
        ]);
    }
}
