<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'members';

    protected $fillable = [
        'catchment_id', 'firstname', 'lastname', 'othername', 'title', 'position', 'gender', 'dob', 'marital_status', 'previous_church_bg', 'phone_number', 'whatsapp_number', 'occupation', 'location', 'invited_by', 'any_relations', 'relation_id', 'baptized', 'foundation_sch_status', 'sld_subscription',
    ];

    public function related_member()
    {
        return $this->belongsTo(Member::class, 'relation_id');
    }

    public function catchment()
    {
        return $this->belongsTo(Catchment::class, 'catchment_id');
    }

    public function programmesAttended()
    {
        return $this->belongsToMany(Programme::class, 'programme_attendance');
    }
}
