<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'visitors';

    protected $fillable = [
        'catchment_id', 'firstname', 'lastname', 'othername', 'title', 'gender', 'dob', 'marital_status', 'previous_church_bg', 'phone_number', 'whatsapp_number', 'occupation', 'location', 'invited_by', 'any_relations', 'baptized', 'foundation_sch_status', 'sld_subscription', 'attendance', 'attendance_days'
    ];

    public function catchment()
    {
        return $this->belongsTo(Catchment::class, 'catchment_id');
    }
}
