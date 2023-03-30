<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDetails extends Model
{
    use HasFactory;
    public $table='schooldetails';
    protected $fillable = [
        'SchoolName', 'AddressLine1','AddressLine2', 'AddressLine3','City',
        'State', 'Country','Pin', 'ContactPerson','Email','Phone1','Phone2',
        'WhatsAppNo','WebsiteLink',
    ];
}
