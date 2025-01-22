<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PerawatanSelesaiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $title;
    public $nama;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct($data)
    {
        // Menyimpan data ke dalam properti kelas
        $this->subject = $data['subject'];
        $this->title = $data['title'];
        $this->nama = $data['nama'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Mengatur subjek dan tampilan email
        return $this->subject($this->subject)
                    ->view('emails.perawatan_selesai')
                    ->with([
                    'subject' => $this->subject,
                    'title' => $this->title,
                    'nama' => $this->nama,
                    ]);
    }
}
