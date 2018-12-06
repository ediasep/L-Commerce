<?php 

use App\Product;
use Illuminate\Support\Facades\Route;


// SLUG HELPER ==============================================================================
function createSlug($title, $id = 0)
{
    // Normalize the title
    $slug = str_slug($title);
    // Get any that could possibly be related.
    // This cuts the queries down by doing it once.
    $allSlugs = getRelatedSlugs($slug, $id);
    // If we haven't used it before then we are all good.
    if (! $allSlugs->contains('slug', $slug)){
        return $slug;
    }
    // Just append numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
        $newSlug = $slug.'-'.$i;
        if (! $allSlugs->contains('slug', $newSlug)) {
            return $newSlug;
        }
    }
    throw new \Exception('Can not create a unique slug');
}

function getRelatedSlugs($slug, $id = 0)
{
    return Product::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
}

// ROUTE HELPER ==============================================================================

function isActiveRoute($route)
{
    if(is_array($route))
        return in_array(Route::currentRouteName(), $route) ? 'active' : '';

    return Route::currentRouteName() == $route ? 'active' : '';
}