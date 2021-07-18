<?php

namespace App\Repositories\Classes;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;
class TaskRepository implements TaskRepositoryInterface{
    

    public function all(){
        $all = Task::all();
        return $all;
    }
    public function create(Request $request){
        return Task::create($request->only(['name']));
    }
    public function update(Request $request, $id){
        $update = Task::where('id', $id)->update($request->only(['name']));
        return $update;
    }
    public function findById($id){
        return Task::find($id);
    }
    public function delete($id){
        return Task::find($id)->delete();
    }

    public function markAsToggle($id){
        $update = Task::where('id', $id);
        $toggle = ($update->first()->status == "complete") ? "incomplete" : 'complete';
        $update->update(['status' => $toggle]);
        return $update;
    }

}