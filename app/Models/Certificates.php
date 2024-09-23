<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;
    protected $table = 'certificates';
    protected $primaryKey = 'id_certificate';
    protected $fillable = ['course_id', 'code', 'course_or_event', 'full_name', 'document_number', 'score', 'email', 'issued_date', 'status'];

}
