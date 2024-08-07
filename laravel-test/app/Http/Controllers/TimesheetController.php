<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function store(Request $request)
    {
        $timesheet = Timesheet::create($request->all());
        return response()->json($timesheet, 201);
    }

    public function show($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        return response()->json($timesheet);
    }

    public function index(Request $request)
    {
        $query = Timesheet::query();

        if ($request->has('task_name')) {
            $query->where('task_name', $request->task_name);
        }
        if ($request->has('date')) {
            $query->where('date', $request->date);
        }
        if ($request->has('hours')) {
            $query->where('hours', $request->hours);
        }

        return response()->json($query->get());
    }

    public function update(Request $request)
    {
        $timesheet = Timesheet::findOrFail($request->id);
        $timesheet->update($request->all());
        return response()->json($timesheet);
    }

    public function destroy(Request $request)
    {
        $timesheet = Timesheet::findOrFail($request->id);
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted successfully']);
    }
}
