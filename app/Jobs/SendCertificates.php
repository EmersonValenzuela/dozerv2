<?php

namespace App\Jobs;

use App\Mail\NotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCertificates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $studentRecord;  // Información del estudiante
    protected $viewTemplate;  // Nombre de la vista a usar
    protected $certificateText;  // Texto relacionado con el certificado
    protected $fileAttachment;  // Nombre del archivo adjunto
    protected $subject;  // Asunto del correo

    /**
     * Create a new job instance.
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
        $this->fileAttachment = $fileAttachment; // Asigna el nombre del archivo
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Envía el correo usando NotificationMail con los parámetros necesarios
        Mail::to($this->studentRecord['email'])->send(new NotificationMail($this->studentRecord, $this->viewTemplate, $this->certificateText, $this->fileAttachment, $this->subject));
    }
}
