<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    // Định nghĩa khóa chính slide_id của bảng slides
    protected $primaryKey = 'slide_id';


    protected $fillable = [
        'title',
        'image',
        'description',
        'link',
    ];
}
