<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    public $table='faculty';
    protected $fillable = [
        'FacultyCode', 'Title','firstName','lastName','DOB','DateOfJoining', 'Gender'
        ,'Qualification','WorkingStartTime','WorkingEndTime','Status',"Role",
        "email",
        "image",
        'MobileNo',
        'AddressLine1',
        'AddressLine2',
        'AddressLine3',
    ];
}
