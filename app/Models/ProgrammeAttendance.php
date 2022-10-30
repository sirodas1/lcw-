<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeAttendance extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'programme_attendance';

    protected $fillable = [
        'programme_id', 'member_id',
    ];
}
