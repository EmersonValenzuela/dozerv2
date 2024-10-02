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
            ->select('code', 'full_name', 'id_student', 'code', 'course_or_event')
            ->get();
    }

    /**
     * Contar los estudiantes de un curso cuyo c_m sea true.
     *
     * @param int $courseId
     * @return int
     */
    public function countStudentsWithCM($courseId)
    {
        // Contar los estudiantes cuyo c_m sea true (1) para un curso específico
        return $this->where('course_id', $courseId)
            ->where('c_m', 1)
            ->count();
    }
}
