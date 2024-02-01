<?php
namespace App\Repository\Item;

interface ItemRepositoryInterface {

    public function store(array $data);

    public function showList();

    public function update(array $data);

    public function edit(int $id);

    // public function delete();

}
