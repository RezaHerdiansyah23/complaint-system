<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'complaint_id',
        'user_id',
        'rating',
        'comment',
    ];


    public function feedback()
{
    return $this->hasOne(Feedback::class);
}

 public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}