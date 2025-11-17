<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Account;
use App\Models\TwoFACode;

class TwoFACodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $account;
    public $twoFACode;

    /**
     * Create a new message instance.
     */
    public function __construct(TwoFACode $twoFACode, Account $account)
    {
        $this->twoFACode = $twoFACode;
        $this->account = $account;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your PHP Bank Security Code',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.two-fa-code',
            with: [
                'code' => $this->twoFACode->code,
                'accountName' => $this->account->first_name . ' ' . $this->account->last_name,
                'expiresAt' => $this->twoFACode->expires_at,
                'remainingMinutes' => $this->twoFACode->remaining_minutes
            ]
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