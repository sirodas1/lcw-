<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SundayAttendanceVisitor extends Model
{
    use HasFactory;
    protected $table = 'sunday_attendance_visitors';
    protected $primaryKey = 'id';

    protected $fillable = ['sunday_date', 'zone_id', 'report_id', 'visitor_id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }
}
