<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\response;

class Complaint extends Model
{
    //

    protected $fillable = [
    'user_id',
    'title',
    'description',
    'attachment',
    'status',
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function response()
{
    return $this->hasOne(Response::class);
}



}
