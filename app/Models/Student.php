<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $table='student';
    protected $fillable = [
        
        'StudentCode', 'RollNo','StudentName', 'DOB','DateOfJoining', 'Gender'
        ,'CourceCode','BatchCode','AcademinSession','Status',
        'AddressLine1','AddressLine2','AddressLine3',
        'mobile','email','prevclsname',"Location",
        'prevownername','prevownerno','classinfo','courses','promoted','Title',
    ];
}
