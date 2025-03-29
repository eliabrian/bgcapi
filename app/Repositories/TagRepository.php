<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Spatie\QueryBuilder\QueryBuilder;

class TagRepository
{
    /**
     * Fetch all tags.
     *
     * @return Paginator
     */
    public function all(): Paginator
    {
        return QueryBuilder::for(Tag::class)
            ->allowedFilters(['name', 'slug'])
            ->allowedIncludes(['games.difficulty'])
            ->paginate();
    }

    /**
     * Fetch a tag by id.
     *
     * @param string $id
     *
     * @return Tag
     */
    public function get(string $id): Tag
    {
        return QueryBuilder::for(Tag::class)
            ->allowedIncludes(['games.difficulty'])
            ->findOrFail($id);
    }
}
