<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Set the next priority for new books when creating new records
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function (Model $book) {
            $book->priority = Auth::user()->books()->max('priority') + 1;
        });
    }

    /**
     * Get the user relationship
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Local scope for retrieving by custom user priority
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePriority(Builder $query): Builder
    {
        return $query->orderBy('priority');
    }
}
