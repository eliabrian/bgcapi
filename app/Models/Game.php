<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'tag_id',
        'difficulty_id',
        'player_min',
        'player_max',
        'age',
        'duration',
        'summary',
        'description',
    ];

    /**
     * Fetch the tag that owns the game.
     *
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * Fetch the difficulty that owns the game.
     *
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }
}
