<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulerHeader extends Model
{
    use HasFactory;
    public $table='schedulerHeader';
    protected $fillable = [
        'CourceCode','BatchCode','Status','Date','LineNo','Status','MainLocation',
    ];
}
