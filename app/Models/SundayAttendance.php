<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SundayAttendance extends Model
{
    use HasFactory;
    protected $table = 'sunday_attendance';
    protected $primaryKey = 'id';

    protected $fillable = ['sunday_date', 'zone_id', 'report_id', 'member_id', 'attendance', 'reason'];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
