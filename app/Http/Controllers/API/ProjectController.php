<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies'/* , 'types' */)->orderByDesc('id')->paginate(12);
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
    public function show($slug)
    {
        $project = Project::with('technologies'/* , 'types' */)->where('slug', $slug)->first();;

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 404);
        }
    }
}
