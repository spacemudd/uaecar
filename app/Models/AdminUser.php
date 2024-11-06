<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // <-- This is the key
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminUser extends Authenticatable  // <-- Extend Authenticatable
{
    use HasFactory;

    // Specify the table name if it’s not the plural form of the model
    protected $table = 'admin_users';

    // Define which attributes are mass assignable (to protect against mass-assignment vulnerability)
    protected $fillable = ['username', 'email', 'password', 'role'];

    // Optionally, if you're not using timestamps (timestamps = false)
    // public $timestamps = false;

    // Additional custom methods, if necessary (e.g. password hashing, etc.)
}
