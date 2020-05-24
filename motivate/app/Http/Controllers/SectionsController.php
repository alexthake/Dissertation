<?php

namespace App\Http\Controllers;

use App\Section;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{
    public function show($id)
    {
        return response(Section::find($id), Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $section = new Section();
        $section->section_name = 'New Section';
        $section->project_id = $request->project_id;
        $section->save();

        return response($section->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function store(Request $request)
    {   
        $section = new Section;
        $section->section_name = $request->section_name;
        $section->section_due = $request->section_due;
        $section->project_id = $request->project_id;

        $section->save();

        return $section->id;
    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);

        $section->section_name = $request->section_name;
        $section->section_due = $request->section_due;
        $section->project_id = $request->project_id;

        $section->save();
    }

    public function destroy($id)
    {
        Section::destroy($id);

        return response(null, Response::HTTP_OK);
    }

    public function sectionsByProject($projectId)
    {
        return Section::where('project_id', $projectId)->get();
    }

    public function sectionProgress($sectionId)
    {
        $tasks[0] = Task::where('section_id', $sectionId)->get()->count();
        $tasks[1] = Task::where([['section_id', $sectionId],['task_completed', true]])->get()->count();
        return $tasks;
    }
}