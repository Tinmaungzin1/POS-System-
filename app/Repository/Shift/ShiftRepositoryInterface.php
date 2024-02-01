<?php
namespace App\Repository\Shift;

interface ShiftRepositoryInterface {

    public function create(array $data);

    public function getShiftStart();

    public function updateShiftEnd();

    public function showList();
}