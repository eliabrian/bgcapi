<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Contracts\Pagination\Paginator;
use Spatie\QueryBuilder\QueryBuilder;

class GameRepository
{
    /**
     * Fetch all tags.
     *
     * @return Paginator
     */
    public function all(): Paginator
    {
        return QueryBuilder::for(Game::class)
            ->allowedFilters(['name', 'slug'])
            ->allowedIncludes(['tag', 'difficulty'])
            ->paginate();
    }

    /**
     * Fetch a game by id.
     *
     * @param string $id
     *
     * @return Game
     */
    public function get(string $id): Game
    {
        return QueryBuilder::for(Game::class)
            ->allowedIncludes(['tag', 'difficulty'])
            ->findOrFail($id);
    }
}
