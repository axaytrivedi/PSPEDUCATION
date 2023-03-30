<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyAttendance extends Model
{
    use HasFactory;
    public $table='facultyAttendance';

    protected $fillable = [
        'FacultyCode', 'CalanderDate','InTime', 'OutTime','AttendanceStatus',
    ];
}
