<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'programmes';

    protected $fillable = [
        'name', 'recuring', 'date_and_time'
    ];

    public function attendance()
    {
        return $this->belongsToMany(Member::class, 'programme_attendance');
    }
}
