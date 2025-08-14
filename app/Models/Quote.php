<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'content',
        'user_id',
        'actor', // scheduler or worker
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
