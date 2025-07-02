<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\UserMail;

class ReplyToUserMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;

    /**
     * Create a new message instance.
     */
    public function __construct(UserMail $mail)
    {
        $this->mail = $mail;
    }

    public function build()
    {
        return $this->subject('Balasan dari PT. Nusantara Tech')
                    ->view('emails.user-reply')
                    ->with(['reply' => $this->mail->reply, 'name' => $this->mail->name]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply To User Message',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
