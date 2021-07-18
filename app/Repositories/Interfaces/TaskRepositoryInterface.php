<?php

namespace App\Repositories\interfaces;
use Illuminate\Http\Request;

interface TaskRepositoryInterface{

    public function all();
    public function create(Request $request);
    public function update(Request $request, $id);
    public function findById($id);
    public function delete($id);
    public function markAsToggle($id);
}