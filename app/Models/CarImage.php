<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'image_path']; // Update field name to match your table
    
    // Specify the table name explicitly if needed
    protected $table = 'car_gallery';

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
