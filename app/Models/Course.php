<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $primaryKey = 'id_course';

    protected $fillable = ['certificate_type_id', 'program_type_id', 'course_or_event', 'image_one', 'image_two', 'dateFinish'];

}
