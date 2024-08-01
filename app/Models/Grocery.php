<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $item
 * @property \Illuminate\Support\Carbon $purchased_at
 * @property User $user
 */
class Grocery extends Model
{
    use HasFactory, SoftDeletes;

    const DELETED_AT = 'purchased_at';

    protected $fillable = [
        'user_id',
        'item',
        'purchased_at',
    ];


    protected $casts = [
        'purchased_at' => 'datetime',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wasPurchased(): bool
    {
        return !is_null($this->purchased_at);
    }


    public function scopeUnpurchased($query)
    {
        return $query->whereNull('purchased_at');
    }
}
