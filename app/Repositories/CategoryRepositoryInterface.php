<?php

namespace App\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function create(array $data);

    public function update(Category $Category, array $data);

    public function delete(Category $Category);

    public function getById(int $id);

    public function getByUserId(int $id);

    public function getAll();
    public function paginate(int $number);

}
