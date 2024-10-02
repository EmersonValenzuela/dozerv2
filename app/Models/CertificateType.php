<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_certificate_type';
    protected $fillable = ['name'];

    public function programTypes()
    {
        return $this->belongsToMany(ProgramType::class, 'certificate_programs', 'id_certificate_type', 'id_program_type');
    }

}
