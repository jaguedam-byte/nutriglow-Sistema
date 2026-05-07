<?php

namespace App\Mail;

use App\Models\BillingInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BillingInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public BillingInvoice $invoice,
        public string $pdfPath,
        public string $fileName
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu factura de Nutri Glow Admin',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.billing-invoice',
        );
    }

    public function build(): static
    {
        return $this->attachFromStorageDisk('local', $this->pdfPath, $this->fileName, [
            'mime' => 'application/pdf',
        ]);
    }
}
