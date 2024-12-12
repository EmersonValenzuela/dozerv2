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

    public static function studentConstancy($course)
    {
        return static::query()
            ->where('course_id', $course)
            ->where('certificate', 0)
            ->where('c_p', 0)
            ->select('code', 'full_name', 'id_student', 'code', 'course_or_event')
            ->get();
    }

    public static function studentRecognition($course)
    {
        return static::query()
            ->where('course_id', $course)
            ->whereIn('score', [19, 20])
            ->where('r_e', 0)
            ->select('code', 'full_name', 'id_student', 'code', 'course_or_event')
            ->get();
    }

    public static function studentCertificate($course)
    {
        return static::query()
            ->where('course_id', $course)
            ->where('c_p', 0)
            ->where('certificate', 0)
            ->where('score' > 10)
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


    public static function getStudentByCourse($courseId)
    {
        $students = self::where('course_id', $courseId)
            ->get();

        $data = [];
        foreach ($students as $student) {
            $data[] = [
                'id' => $student->id_student,
                'code' => $student->code,
                'names' => $student->full_name,
                'document' => $student->document_number,
                'email' => $student->email,
                'score' => $student->score,
                'course' => $student->course_or_event,
                'cm' => $student->c_m,
                'cp' => $student->c_p,
                'r_e' => $student->r_e,
                'w_p' => $student->w_p,
                'certificate' => $student->certificate,
                'status' => $student->status,
            ];
        }
        return $data;
    }


    public static function getStudentByWebinar($webinarId)
    {
        $students = self::where('course_id', $webinarId)
            ->get();

        $data = [];
        foreach ($students as $student) {
            $data[] = [
                'id' => $student->id_student,
                'code' => $student->code,
                'document' => $student->document_number,
                'names' => $student->full_name,
                'email' => $student->email,
                'course' => $student->course_or_event,
                'w_p' => $student->w_p,
            ];
        }
        return $data;
    }
}
