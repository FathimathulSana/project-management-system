<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($projectId)
    {
        try {
            $project = Project::where('id', $projectId)
                ->where('user_id', Auth::id())
                ->first(['id', 'project_name']);

            if (!$project) {
                return response()->json(['success' => false, 'err_msg' => 'Project not found.'], 404);
            }

            $tasks = $project->tasks()->paginate(10);

            return response()->json([
                'success' => true,
                'project_name' => $project->project_name,
                'tasks' => $tasks
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to fetch project tasks', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(TaskRequest $request, $projectId)
    {
        try {
            $project = Project::where('id', $projectId)
                ->where('user_id', Auth::id())
                ->first();

            if (!$project) {
                return response()->json(['success' => false, 'err_msg' => 'Project not found.'], 404);
            }

            $task = $project->tasks()->create([
                'task_name' => $request->input('task_name'),
                'description' => $request->input('description'),
            ]);

            return response()->json(['success' => true, 'task' => $task], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to create project task', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $projectId, $id)
    {
        try {
            $task = Task::where('id', $id)->where('project_id', $projectId)->first();

            if (!$task) {
                return response()->json(['err_msg' => 'Task not found.'], 404);
            }

            $task->update([
                'task_name' => $request->input('task_name'),
                'description' => $request->input('description'),
            ]);

            return response()->json(['success' => true, 'task' => $task], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to update task', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $projectId, $id)
    {
        try {

            $task = Task::where('id', $id)->where('project_id', $projectId)->first();

            if (!$task) {
                return response()->json(['success' => false, 'err_msg' => 'Task not found.'], 404);
            }

            $task->delete();

            return response()->json(['success' => true, 'message' => 'Deleted the task successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to delete task', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(StatusRequest $request, $id)
    {
        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(['err_msg' => 'Task not found.'], 404);
            }

            $task->update([
                'status' => $request->status,
            ]);

            $task->statuses()->create([
                'status' => $request->status,
            ]);

            return response()->json(['success' => true, 'message' => "Status changed successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to update status', 'error' => $e->getMessage()], 500);
        }
    }

    public function addRemark(Request $request, $id)
    {
        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(['err_msg' => 'Task not found.'], 404);
            }

            $task->remarks()->create([
                'remark' => $request->remark,
            ]);

            return response()->json(['success' => true, 'message' => "Remark added successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to add remark', 'error' => $e->getMessage()], 500);
        }
    }
}
