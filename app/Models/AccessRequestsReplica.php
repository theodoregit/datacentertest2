<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRequestsReplica extends Model
{
    use HasFactory;
    protected $fillable = [
        'requestno', 'fullname', 'phone_number', 'id_number', 'date', 'starting_date', 'end_date', 'visiting_days', 'remaining_days', 'access_req_location',
        'access_time', 'areas_tobe_accessed', 'personnel1', 'personnel2', 'personnel3', 'personnel4', 'personnel5', 'personnel6', 
        'personnel7', 'personnel8', 'personnel9', 'personnel10', 'escortingteam', 'escorts', 'location', 'impact', 'purpose', 'letter', 
        'status', 'is_confirmed', 'is_approved', 'is_denied', 'is_rejected', 'unit','denial_reason', 'rejection_reason'
    ];
}
