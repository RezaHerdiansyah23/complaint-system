<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Response;

class Complaint extends Model
{
    //

    protected $fillable = [
    'user_id',
    'title',
    'company_name', 
    'description',
    'attachment',
    'status',
    'verification_status',
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function response()
{
    return $this->hasOne(Response::class);
}

  public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan keyword pencarian
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $searchTerm = trim($search);
            
            // Lakukan pencarian di beberapa kolom
            $query->where(function ($query) use ($searchTerm) {
                // 1. Cari di judul keluhan
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('company_name', 'like', '%' . $searchTerm . '%')
                      // 2. ATAU cari di nama pengguna yang berelasi
                      ->orWhereHas('user', function ($query) use ($searchTerm) {
                          $query->where('full_name', 'like', '%' . $searchTerm . '%');
                      });
            });
        });        // Filter berdasarkan status
        $query->when($filters['status'] ?? false, function ($query, $status) {
            $dbStatus = match ($status) {
                'In Progress' => 'in_progress',
                'Completed' => 'resolved',
                default => strtolower($status),
            };
            $query->where('status', $dbStatus);
        });

        $query->when($filters['verification_status'] ?? false, function ($query, $status) {
        // Langsung cari berdasarkan nilai dari dropdown ('pending', 'accepted', 'rejected')
        return $query->where('verification_status', $status);
    });
    }
}


