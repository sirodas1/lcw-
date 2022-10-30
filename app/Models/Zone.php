<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'zones';

    protected $fillable = [
        'name', 'leader_id',
    ];

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function catchments()
    {
        return $this->hasMany(Catchment::class, 'zone_id');
    }

    public function anonymous_members()
    {
        return $this->belongsToMany(Member::class, 'anonymous_zone_members');
    }
}
