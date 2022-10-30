<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catchment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'catchments';

    protected $fillable = [
        'location', 'zone_id',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'catchment_id');
    }
}
