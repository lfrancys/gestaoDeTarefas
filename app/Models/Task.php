<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'user_id',
        'status_id',
        'title',
        'description',
        'due_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
