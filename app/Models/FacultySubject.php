<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultySubject extends Model
{
    use HasFactory;
    public $table='facultysubject';

    protected $fillable = [
        'Location','FacultyCode', 'CourseCode','SubjectCode', 'EffFrom','EffUpto',
    ];
}
