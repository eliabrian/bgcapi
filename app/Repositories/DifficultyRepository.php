<?php

namespace App\Repositories;

use App\Models\Difficulty;
use Illuminate\Contracts\Pagination\Paginator;
use Spatie\QueryBuilder\QueryBuilder;

class DifficultyRepository
{
    /**
     * Fetch all tags.
     *
     * @return Paginator
     */
    public function all(): Paginator
    {
        return QueryBuilder::for(Difficulty::class)
            ->allowedFilters(['name', 'slug'])
            ->allowedIncludes(['games.tag'])
            ->paginate();
    }

    /**
     * Fetch a difficulty by id
     *
     * @param string $id
     *
     * @return Difficulty
     */
    public function get(string $id): Difficulty
    {
        return QueryBuilder::for(Difficulty::class)
            ->allowedIncludes(['games.tag'])
            ->findOrFail($id);
    }
}
