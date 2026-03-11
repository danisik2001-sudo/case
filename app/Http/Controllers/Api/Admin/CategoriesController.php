<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Cases;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function load()
    {
        return Category::query()->orderBy('position', 'desc')->get();
    }

    public function create(Request $request): array
    {
        $category = $request->category;

        if (!$category['name']) return ['success' => false, 'message' => 'Вы не указали название категории'];
        if (!$category['name_en']) return ['success' => false, 'message' => 'Вы не указали название категории англ'];
        if (!$category['position']) return ['success' => false, 'message' => 'Вы не указали название категории'];

        Category::query()->create($category);

        return ['success' => true, 'message' => 'Категория создана'];
    }

    public function get(Request $request): array
    {
        $category = Category::query()->find($request->id);
        if (!$category) return ['success' => false, 'message' => 'Категория не найденa'];

        return ['success' => true, 'category' => $category];
    }

    public function edit(Request $request): array
    {
        $requestCategory = $request->category;
        $category = Category::query()->find($requestCategory['id']);

        if (!$category) {
            return ['success' => false, 'message' => 'Категория не найдена'];
        }

        if (!$requestCategory['name']) return ['success' => false, 'message' => 'Вы не указали название категории'];
        if (!$requestCategory['name_en']) return ['success' => false, 'message' => 'Вы не указали название категории англ'];
        if (!$requestCategory['position']) return ['success' => false, 'message' => 'Вы не указали позицию категории'];

        $category->update($requestCategory);

        return ['success' => true, 'message' => 'Категория изменена'];
    }


    public function delete(Request $request): array
    {
        $category = Category::query()->find($request->id);
        if (!$category) return ['success' => false, 'message' => 'Категория не найдена'];

        Cases::query()->where('category_id', $category->id)->update([
            'category_id' => null
        ]);

        $category->delete();

        return ['success' => true, 'message' => 'Категория удалена'];
    }
}
