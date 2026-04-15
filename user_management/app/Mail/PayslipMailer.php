<?php

namespace App\Mail;

use App\Models\Payslip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayslipMailer extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Payslip $payslip,
        private string $pdfContent,
        private string $pdfFileName
    ) {
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $payPeriod = $this->payslip->pay_period
            ? $this->payslip->pay_period->format('F Y')
            : 'Unknown Period';

        return new Envelope(
            from: new Address(address: config('mail.from.address'), name: config('mail.from.name')),
            subject: "Payslip - {$payPeriod}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.payslip',
            with: [
                'payslip' => $this->payslip,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, $this->pdfFileName)
                ->withMime('application/pdf'),
        ];
    }
}
