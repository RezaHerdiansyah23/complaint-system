<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    //
    protected $fillable = ['complaint_id', 'noc_id', 'notes'];


    // Response.php
public function noc()
{
    return $this->belongsTo(\App\Models\User::class, 'noc_id');
}

public function complaint()
{
    return $this->belongsTo(\App\Models\Complaint::class, 'complaint_id');
}


}
