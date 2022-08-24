<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    protected $fillable = ['name' , 'description', 'website', 'phone', 'user_id', 'average_rating', 'average_cost'];
    use HasFactory;
}
