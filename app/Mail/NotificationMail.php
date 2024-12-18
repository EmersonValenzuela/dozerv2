<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentRecord;    // Información del estudiante
    public $viewTemplate;     // Ruta de la vista dinámica
    public $certificateText;  // Texto del certificado
    public $fileAttachment;   // Nombre del archivo adjunto
    public $subject;          // Asunto del correo

    /**
     * Create a new message instance.
     *
     * @param  array  $studentRecord
     * @param  string  $viewTemplate
     * @param  string  $certificateText
     * @param  string  $fileAttachment
     * @return void
     */
    public function __construct($studentRecord, $viewTemplate, $certificateText, $fileAttachment, $subject)
    {
        $this->studentRecord = $studentRecord;
        $this->viewTemplate = $viewTemplate;
        $this->certificateText = $certificateText;
        $this->fileAttachment = $fileAttachment; // Asigna el archivo adjunto
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        // Asunto dinámico con el texto del certificado
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // Usar la vista dinámica y pasar la información del estudiante
        return new Content(
            view: 'mails.' . $this->viewTemplate,  // Vista dinámica
            with: [
                'studentRecord' => $this->studentRecord,
                'route' => $this->certificateText,
                'name' => $this->fileAttachment
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // Si tienes un archivo adjunto, puedes agregarlo aquí
        // return [
        //     storage_path('app/attachments/' . $this->fileAttachment),
        // ];
        return [];
    }
}
