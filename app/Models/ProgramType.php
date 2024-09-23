<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_program_type';
    protected $fillable = ['name'];
}
