<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'id_student';

    protected $fillable = [
        'course_id',
        'code',
        'course_or_event',
        'full_name',
        'document_number',
        'score',
        'email',
        'c_m',
        'c_p',
        'r_e',
        'w_p',
        'certificate',
        'status'
    ];

    public static function studentEnrollment($course)
    {
        return static::query()
            ->where('course_id', $course)
            ->where('c_m', 0)
            ->select('code','full_name', 'id_student', 'code', 'course_or_event')
            ->get();
    }
}
