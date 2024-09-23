<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_certificate_type';
    protected $fillable = ['name'];

}
