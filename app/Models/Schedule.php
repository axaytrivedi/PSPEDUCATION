<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $table='schedule';

    protected $fillable = [
        'LectureCode', 'CourceCode','BatchCode', 'DateOfWeek','Session','TimingFrom','TimingUpto','',
        'SubjectCode','FacultyCode','Venue','EffFrom','EffUpto',
    ];
}
