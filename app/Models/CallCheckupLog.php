<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCheckupLog extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'call_checkup_log';

    protected $fillable = [
        'user_id', 'member_id', 'status', 'description',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
