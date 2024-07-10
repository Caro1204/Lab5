<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'priority',
        'completed',
        'user_id', // Asegúrate de incluir user_id en fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


