<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_name', 'requestno', 'visiting_date', 'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end', 'personnels'
    ];
}
