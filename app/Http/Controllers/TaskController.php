<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TaskRepositoryInterface;
class TaskController extends Controller
{

    protected $task;
    public function __construct(TaskRepositoryInterface $task){
        $this->task = $task;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->task->all();
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->task->create($request);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($task_id)
    {
        $data = $this->task->findById($task_id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $task_id)
    {
        $data = $this->task->update($request, $task_id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($task_id)
    {
        $data = $this->task->delete($task_id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    /***
     * Mark as complete
     */

    public function markAsToggle($task_id)
    {
        $data = $this->task->markAsToggle($task_id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

}
