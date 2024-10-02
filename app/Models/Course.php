<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $primaryKey = 'id_course';

    protected $fillable = ['code_course', 'certificate_type_id', 'program_type_id', 'course_or_event', 'image_one', 'image_two', 'dateFinish'];

    public function students()
    {
        return $this->hasMany(Students::class, 'course_id', 'id_course');
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('course_or_event', 'LIKE', "%{$searchTerm}%")
            ->orWhere('code_course', 'LIKE', "%{$searchTerm}%");
    }
}
