<?php

namespace App\Http\Controllers;

use App\Project;
use App\Section;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    public function index()
    {
        return response(Project::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function show($id)
    {
        return response(Project::find($id), Response::HTTP_OK);
    }

    public function store(Request $request)
    {   
        $project = new Project;
        $project->project_name = $request->project_name;
        $project->project_due = $request->project_due;
        $project->user_id = $request->user_id;

        $project->save();

        return $project->id;
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $project->project_name = $request->project_name;
        $project->project_due = $request->project_due;
        $project->user_id = $request->user_id;

        $project->save();
    }

    public function destroy($id)
    {
        Project::destroy($id);

        return response(null, Response::HTTP_OK);
    }

    public function projectsByUser($userid)
    {
        return Project::where('user_id', $userid)->get();
    }

    public function projectProgress($projectId)
    {
        $tasks[0] = DB::table('tasks')
        ->join('sections','sections.id', '=', 'tasks.section_id')
        ->join('projects', 'projects.id', '=', 'sections.project_id')
        ->where('project_id', $projectId)
        ->get()->count();

        $tasks[1] = DB::table('tasks')
        ->join('sections','sections.id', '=', 'tasks.section_id')
        ->join('projects', 'projects.id', '=', 'sections.project_id')
        ->where([['project_id', $projectId],['task_completed', true]])
        ->get()->count();
        return $tasks;
    }
}