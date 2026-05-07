<?php

namespace App\Mail;

use App\Models\AgendaAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgendaAppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AgendaAppointment $appointment
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recordatorio de cita para hoy en Nutri Glow Admin',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.agenda-appointment-reminder',
        );
    }
}
