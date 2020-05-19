<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    public function index()
    {
        return response(Project::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function projectsByUser()
    {
        return Project::where('user_id', 3)->get();
    }
}