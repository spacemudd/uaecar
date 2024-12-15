<?php

// app/Models/Ad.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    // تحديد الحقول التي يمكن إدخالها بشكل جماعي
    protected $fillable = ['title', 'message', 'image'];
}
