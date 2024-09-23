<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateProgram extends Model
{
    use HasFactory;
    protected $table = 'certificate_programs';
    protected $primaryKey = 'id_certificate_program';
    protected $fillable = ['id_certificate_type', 'id_program_type'];

    public function certificateType()
    {
        return $this->belongsTo(CertificateType::class, 'id_certificate_type');
    }

    public function programType()
    {
        return $this->belongsTo(ProgramType::class, 'id_program_type');
    }
}
