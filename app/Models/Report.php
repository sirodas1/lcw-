<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $primaryKey = 'id';

    protected $fillable = ['leader_id', 'sunday_date', 'means_of_transport', 'number_of_vehicles_brought', 'recommendations', 'arrival_time', 'number_of_new_souls', 'status'];

    public function zone_leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members_attendance()
    {
        return $this->belongsToMany(Member::class, 'sunday_attendance', 'report_id', 'member_id')->withPivot('attendance', 'reason','sunday_date','zone_id');
    }
    public function absent_members()
    {
        return $this->belongsToMany(Member::class, 'sunday_attendance', 'report_id', 'member_id')
            ->wherePivot('attendance', false)
            ->withPivot('attendance', 'reason','sunday_date','zone_id');
    }
    public function present_members()
    {
        return $this->belongsToMany(Member::class, 'sunday_attendance', 'report_id', 'member_id')
            ->wherePivot('attendance', true)
            ->withPivot('attendance', 'reason','sunday_date','zone_id');
    }
    public function visitors_attendance()
    {
        return $this->belongsToMany(Visitor::class, 'sunday_attendance_visitors', 'report_id', 'visitor_id')->withPivot('sunday_date','zone_id');
    }
}
