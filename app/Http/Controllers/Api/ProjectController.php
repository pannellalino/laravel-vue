<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // restituisce tutti i progetti
    public function index(){
        $projects = Project::all();
        return response()->json(compact('projects'));
    }

    // restituisce un singolo progetto in base allo slug
    // public function show($slug)
    // {
    //     $project = Project::where('slug', $slug)->first();

    //     return response()->json($project);
    // }
}
