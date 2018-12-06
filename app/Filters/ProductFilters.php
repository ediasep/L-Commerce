<?php

namespace App\Filters;

use App\User;
use App\Category;

class ProductFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by', 'popular', 'category', 'word', 'min_price', 'max_price'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter the query by a given slug.
     *
     * @param  string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function category($slug)
    {
        $category_id = Category::SearchId($slug);

        return $this->builder->where('category_id', $category_id);
    }

    /**
     * Filter the query by a given word.
     *
     * @param  string $word
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function word($word)
    {
        $category_id = Category::searchId($word);

        return $this->builder->where('name', 'like', '%'.$word.'%');
    }

    /**
     * Filter the query by a given min-price.
     *
     * @param  string $word
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function min_price($price)
    {
        return $this->builder->where('price', '>=', $price);
    }

    /**
     * Filter the query by a given max-price.
     *
     * @param  string $word
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function max_price($price)
    {
        return $this->builder->where('price', '<=', $price);
    }
}
