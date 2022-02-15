<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checks extends Model
{
    use HasFactory;
    protected $fillable = ['requestno', 'admin', 'date', 'location', 'checkedin', 'checkedout', 'personnels'];
}
