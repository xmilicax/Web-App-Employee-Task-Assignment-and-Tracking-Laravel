<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class VerificationMail extends Mailable
    {
        use Queueable, SerializesModels;

        private $poruka;
        private $name;

        /**
         * Create a new message instance.
         */
        public function __construct($name, $poruka = 'Da')
        {
            $this->poruka = $poruka;
            $this->name = $name;
        }

        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Verification Mail',
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
         * @return VerificationMail
         */

        public function build()
        {
            return $this->from('ppp2projekat@gmail.com', 'PPP2 Projekat - Laravel')->view('email',
                [
                    'name' => $this->name,
                    'poruka' => $this->poruka
                ]);
        }

        public function attachments(): array
        {
            return [];
        }
    }
