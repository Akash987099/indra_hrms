<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use App\Models\ShiftRoster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $week = $request->get('week', now()->format('Y-\WW'));
        $department = $request->get('department', '');

        $shifts = Shift::orderBy('id')->get();

        $rostersQuery = ShiftRoster::with([
            'employee:id,first_name,last_name,department',
            'shift:id,name,start_time,end_time'
        ])
            ->where('week', $week);

        if ($department) $rostersQuery->where('department', $department);

        $rosters = $rostersQuery->orderBy('shift_date')->get();

        return view('admin.shift.index', compact('week', 'department', 'shifts', 'rosters'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'week' => ['required', 'regex:/^\d{4}-W\d{2}$/'], // ✅ correct week format
            'department' => 'required|string|max:100',
            'auto_assign' => 'nullable',
        ]);

        $week = $validated['week'];
        $department = $validated['department'];

        $firstShift = Shift::orderBy('id')->first();
        if (!$firstShift) return back()->with('error', 'Please create shifts first.');

        $employees = Employee::where('department', $department)->select('id')->get();
        if ($employees->isEmpty()) return back()->with('error', 'No employees found in this department.');

        $year = (int) substr($week, 0, 4);
        $weekNo = (int) substr($week, 6, 2);
        $monday = Carbon::now()->setISODate($year, $weekNo, 1);

        foreach ($employees as $emp) {
            for ($i = 0; $i < 7; $i++) {
                $date = $monday->copy()->addDays($i)->toDateString();

                ShiftRoster::updateOrCreate(
                    [
                        'week' => $week,
                        'employee_id' => $emp->id,
                        'shift_date' => $date,
                    ],
                    [
                        'department' => $department,
                        'shift_id' => $firstShift->id,
                        'status' => 'Draft',
                        'created_by' => auth()->id(),
                    ]
                );
            }
        }

        return redirect()->route('admin.shift.index', ['week' => $week, 'department' => $department])
            ->with('success', 'Roster generated (Draft).');
    }

    public function publish(Request $request)
    {
        $validated = $request->validate([
            'week' => 'required|string',
            'department' => 'required|string|max:100',
        ]);

        ShiftRoster::where('week', $validated['week'])
            ->where('department', $validated['department'])
            ->update([
                'status' => 'Published',
                'published_by' => auth()->id(),
                'published_at' => now(),
            ]);

        return back()->with('success', 'Roster published.');
    }

    // ✅ JSON load roster (for calendar UI)
    public function load(Request $request)
    {
        $week = $request->get('week');
        $department = $request->get('department', '');

        $q = ShiftRoster::with(['employee:id,first_name,last_name', 'shift:id,name,start_time,end_time'])
            ->where('week', $week);

        if ($department) $q->where('department', $department);

        return response()->json([
            'status' => true,
            'data' => $q->orderBy('shift_date')->get(),
        ]);
    }
}
