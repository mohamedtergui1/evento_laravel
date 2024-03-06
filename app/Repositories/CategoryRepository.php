<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $Category, array $data)
    {
        $Category->update($data);
        return $Category;
    }

    public function delete(Category $Category)
    {
        return $Category->delete();
    }

    public function getById(int $id)
    {
        return Category::find($id);
    }
    public function getByUserId(int $id)
    {
        return Category::where("user_id", $id)->get();
    }

    public function getAll()
    {
        return Category::all();
    }
    public function paginate(int $number)
    {
        return Category::paginate($number);
    }
}
