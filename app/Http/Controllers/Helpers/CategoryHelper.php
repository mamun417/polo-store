<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryHelper extends Controller
{
    /**
     * Get parents categories list default included disable category
     * @param bool $disable
     * @return mixed
     */
    public static function getMainCategories($disable = true)
    {
        $paren_categories = Category::latest()->with('children')->mainCategory();

        if (!$disable) {
            $paren_categories = $paren_categories->active();
        }

        return $paren_categories->get();
    }

    /**
     * remove parent or nested children category by id
     * @param $categories
     * @param $id
     * @return mixed
     */
    public static function removeCategoryById($categories, $id)
    {
        foreach ($categories as $key => $category) {
            if (count($category->children)) {
                self::removeCategoryById($category->children, $id);
            }

            if ($category->id === $id) {
                unset($categories[$key]);
            }
        }

        return $categories;
    }
}
