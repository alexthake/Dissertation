<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function show($id)
    {
        return response(Task::find($id), Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $task = new Task();
        $task->task_name = 'New Task';
        $task->task_description = null;
        $task->task_due = null;
        $task->task_completed = false;
        $task->completion_date = null;
        $task->task_priority = 1;
        $task->task_progress_weight = 1;
        $task->section_id = $request->section_id;
        $task->save();

        return response($task->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function store(Request $request)
    {   
        $task = new Task;
        $task->task_name = $request->task_name;
        $task->task_due = $request->task_due;
        $task->section_id = $request->section_id;

        $task->save();

        return $task->id;
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->task_name = $request->task_name;
        $task->task_description = $request->task_description;
        $task->task_due = (($request->task_due == 'null') ? null : $request->task_due);
        $task->task_completed = (int)$request->task_completed;
        $task->completion_date = (($request->completion_date == 'null') ? null : $request->completion_date);
        $task->task_priority = $request->task_priority;
        $task->task_progress_weight = $request->task_progress_weight;
        $task->section_id = $request->section_id;

        $task->save();
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return response(null, Response::HTTP_OK);
    }

    public function tasksBySection($sectionId)
    {
        return Task::where('section_id', $sectionId)->get();
    }

    public function tasksByProject($projectId)
    {
        return Task::select('tasks.id', 'tasks.completion_date', 'projects.created_at')
        ->join('sections', 'sections.id', '=', 'tasks.section_id')
        ->join('projects', 'projects.id', '=', 'sections.project_id')
        ->where('sections.project_id', $projectId)
        ->get();
    }

    public function tasksByUser($userId)
    {
        return Task::select('tasks.id', 'tasks.completion_date', 'sections.project_id', 'projects.project_name', 'projects.created_at', 'projects.project_due')
        ->join('sections', 'sections.id', '=', 'tasks.section_id')
        ->join('projects', 'projects.id', '=', 'sections.project_id')
        ->where('projects.user_id', $userId)
        ->get();
    }
}