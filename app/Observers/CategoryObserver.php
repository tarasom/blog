<?php

namespace app\Observers;

use App\Entities\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{

    /**
     * Listen to the Category deleting event.
     *
     * @param Category $category
     */
    public function deleting(Category $category)
    {
        $category->posts()->sync([]);
    }
}
