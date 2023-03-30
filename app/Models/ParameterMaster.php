<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterMaster extends Model
{
    use HasFactory;
    protected $table="parameter_masters";
    protected $fillable = ['ParaID', 'Parameter','ParaFilter1', 'ParaFilter2','ParaCode', 'ParaDescription'
        ,'ParaValue','Validity','Approved'
    ];
}
