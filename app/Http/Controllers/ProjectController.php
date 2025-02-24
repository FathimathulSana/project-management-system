<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{

    public function index()
    {
        try {
            $projects = Project::where('user_id', Auth::id())->paginate(10);

            return response()->json(['success' => true, 'projects' => $projects], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to fetch projects', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(ProjectRequest $request)
    {
        try {

            $project = Project::create([
                'project_name' => $request->input('project_name'),
                'description' => $request->input('description'),
            ]);

            return response()->json(['success' => true, 'project' => $project], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to create project', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $project = Project::where('id', $id)->where('user_id', Auth::id())->first();

            if (!$project) {
                return response()->json(['error' => 'Project not found.'], 404);
            }

            $project->update([
                'project_name' => $request->input('project_name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            return response()->json(['success' => true, 'project' => $project], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to update project', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $project = Project::where('id', $id)->where('user_id', Auth::id())->first();

            if (!$project) {
                return response()->json(['success' => false, 'error' => 'Project not found.'], 404);
            }

            $project->delete();

            return response()->json(['success' => true, 'message' => 'Deleted the project successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to delete project', 'error' => $e->getMessage()], 500);
        }
    }

    public function projectReport($id)
    {
        try {
            $project = Project::with(['tasks.statuses', 'tasks.remarks'])
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$project) {
                return response()->json(['success' => false, 'error' => 'Project not found.'], 404);
            }

            return response()->json(['success' => true, 'project' => $project], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to fetch project report', 'error' => $e->getMessage()], 500);
        }
    }
}
