<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appt extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'start_time',
        'end_time',
        'status',
    ];

    // Cast the start_time and end_time fields to datetime
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function mentor()
{
    return $this->belongsTo(User::class, 'mentor_id');
}

public function mentee()
{
    return $this->belongsTo(User::class, 'mentee_id');
}

}
