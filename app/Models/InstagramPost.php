<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramPost extends Model
{
    use HasFactory;

    // تأكد من إضافة الحقول التي يمكن تعبئتها
    protected $fillable = ['url'];
}