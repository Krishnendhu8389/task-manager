<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'user_id',
    ];

    // Cast due_date to Carbon
    protected $casts = [
        'due_date' => 'date',
    ];

    // Link task to its owner
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

