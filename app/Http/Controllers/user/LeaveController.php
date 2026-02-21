<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApplication;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $employee_id = Auth::guard('user')->user()->id;

        $leaves = LeaveApplication::where('employee_id', $employee_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
  
        $total = LeaveApplication::where('employee_id', $employee_id)->count();

        return view('employee.leave.index', compact('leaves', 'total'));
    }

    public function store(Request $request)
    {
        $employee_id = Auth::guard('user')->user()->id;

        $request->validate([
            'leave_type' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'days' => 'required|numeric',
            'reason' => 'required'
        ]);

        LeaveApplication::create([
            'employee_id' => $employee_id,
            'leave_type' => $request->leave_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'duration_days' => $request->days,
            'reason' => $request->reason,
            'contact_no' => $request->contact,
            'handover_to' => $request->handover_to,
            'status' => 'Pending'
        ]);

        return response()->json(['success' => true]);
    }

    // ✅ EXPORT
    public function export()
    {
        $employee_id = Auth::guard('user')->user()->id;

        $leaves = LeaveApplication::where('employee_id', $employee_id)->get();

        $filename = "leave_report.csv";

        return new StreamedResponse(function () use ($leaves) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID', 'Type', 'From', 'To', 'Days', 'Status'
            ]);

            foreach ($leaves as $leave) {
                fputcsv($handle, [
                    $leave->id,
                    $leave->leave_type,
                    $leave->from_date,
                    $leave->to_date,
                    $leave->days,
                    $leave->status
                ]);
            }

            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }
}