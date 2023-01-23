<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'upload_files';

    protected $fillable = ['filename', 'file_type', 'file_path', 'zone_head_status'];
}
