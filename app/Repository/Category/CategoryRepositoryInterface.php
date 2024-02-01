<?php
namespace App\Repository\Category;

interface CategoryRepositoryInterface {

    public function store(array $data);

    public function showList();

    public function edit(int $id);

    public function update(array $data);

    public function delete(array $data);
}
