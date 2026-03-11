<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\CaseItem;
use App\Models\Cases;
use App\Models\Category;
use App\Models\Live;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CasesController extends Controller
{
    public function load(): array
    {
        return [
            'cases' => Cases::query()->with(['category'])->get(),
            'categories' => Category::query()->get()
        ];
    }

    public function create(Request $request): array
    {
        if (!$request->name) return ['success' => false, 'message' => 'Вы не указали название кейса'];
        if (!$request->name_en) return ['success' => false, 'message' => 'Вы не указали название кейса англ'];
        if (!$request->image) return ['success' => false, 'message' => 'Вы не указали картинку кейса'];
        if (!$request->url) return ['success' => false, 'message' => 'Вы не указали ссылку кейса'];
        if ($request->type === 'limited' && !$request->max_opened) return ['success' => false, 'message' => 'Вы не указали макс.кол-во открытий кейса'];
        if (!$request->price && $request->type !== 'free') return ['success' => false, 'message' => 'Вы не указали цену кейса'];
        if ($request->type === 'free' && !$request->min_dep) return ['success' => false, 'message' => 'Вы не указали минимальное пополнение'];
        if ($request->type !== 'default' && $request->type !== 'free' && $request->type !== 'limited') return ['success' => false, 'message' => 'Вы не указали тип кейса'];
        if ($request->type === 'default' && $request->type === 'limited' && $request->type === 'free' && !$request->category_id) return ['success' => false, 'message' => 'Вы не указали категорию кейса'];

        $find = Cases::query()->where('url', $request->url)->first();
        if ($find) return ['success' => false, 'message' => 'Такой URL уже занят'];

        if (preg_match('/[\p{Cyrillic}]/u', $request->url)) return ['success' => false, 'message' => 'Русские символы в URL'];

        $validExtensions = ["gif", "jpg", "jpeg", "png", "webp"];

        $imageNameExtension = $request->file('image')->getClientOriginalExtension();

        if (!in_array(strtolower($imageNameExtension), $validExtensions)) {
            return ['success' => false, 'message' => 'Недопустимый формат файла. Разрешены только: ' . implode(', ', $validExtensions)];
        }
        $imageName = $request->url . '-' . time() . '.' . $imageNameExtension;
        $request->file('image')->move(public_path('/assets/img/cases'), $imageName);

        $price = $request->type === 'free' ? 0 : $request->price;

        Cases::query()->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'image' => $imageName,
            'url' => $request->url,
            'max_opened' => $request->max_opened,
            'price' => $price,
            'type' => $request->type,
            'min_dep' => $request->min_dep,
            'price_old' => $request->price_old,
            'is_show' => $request->is_show,
        ]);

        return ['success' => true, 'message' => 'Кейс создан'];
    }

    public function get(Request $r): array
    {
        $case = Cases::query()->find($r->id);

        if (!$case) return ['success' => false, 'Кейс не существует'];

        return ['success' => true, 'box' => $case];
    }

    public function edit(Request $request): array
    {
        $case = Cases::query()->find($request->id);

        if (!$request->name) return ['success' => false, 'message' => 'Вы не указали название кейса'];
        if (!$request->name_en) return ['success' => false, 'message' => 'Вы не указали название кейса англ'];
        if (!$request->url) return ['success' => false, 'message' => 'Вы не указали ссылку кейса'];
        if ($request->type === 'limited' && !$request->max_opened) return ['success' => false, 'message' => 'Вы не указали макс.кол-во открытий кейса'];
        // if (!$request->price) return ['success' => false, 'message' => 'Вы не указали цену кейса'];
        if ($request->type !== 'default' && $request->type !== 'free' && $request->type !== 'limited') return ['success' => false, 'message' => 'Вы не указали тип кейса'];
        if ($request->type === 'default' && $request->type === 'limited' && !$request->category_id) return ['success' => false, 'message' => 'Вы не указали категорию кейса'];

        $find = Cases::query()->where('url', $request->url)->where('id', '!=', $request->id)->first();
        if ($find) return ['success' => false, 'message' => 'Такой URL уже занят'];

        if (preg_match('/[\p{Cyrillic}]/u', $request->url)) return ['success' => false, 'message' => 'Русские символы в URL'];

        $case->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'url' => $request->url,
            'max_opened' => $request->max_opened,
            'price' => $request->price,
            'price_old' => $request->price_old,
            'min_dep' => $request->min_dep,
            'type' => $request->type,
            'is_show' => $request->is_show,
        ]);

        if (!is_null($request->image)) {
            $validExtensions = ["gif", "jpg", "jpeg", "png", "webp"];

            $imageNameExtension = $request->file('image')->getClientOriginalExtension();

            if (!in_array(strtolower($imageNameExtension), $validExtensions)) {
                return ['success' => false, 'message' => 'Недопустимый формат файла. Разрешены только: ' . implode(', ', $validExtensions)];
            }
            $imageName = $request->url . '-' . time() . '.' . $imageNameExtension;
            $request->file('image')->move(public_path('/assets/img/cases'), $imageName);

            $case->update([
                'image' => $imageName
            ]);
        }

        return [
            'success' => true,
            'message' => 'Кейс обновлён'
        ];
    }

    public function delete(Request $request): array
    {
        $case = Cases::query()->find($request->id);
        if (!$case) return ['success' => false, 'message' => 'Кейс не найден'];

        CaseItem::query()->where('case_id', $case->id)->delete();
        Live::query()->where('case_id', $case->id)->delete();

        if (file_exists(public_path('/assets/img/cases/') . $case->image)) {
            @unlink(public_path('/assets/img/cases/') . $case->image);
        }
        $case->delete();

        return ['success' => true, 'message' => 'Кейс и информация о нём удалены'];
    }
}
