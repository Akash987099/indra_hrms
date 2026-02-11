<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', '');
        $type   = $request->get('type', '');

        $employees = Employee::select('id','first_name','last_name')->orderBy('first_name')->get();

        $q = LeaveApplication::with('employee:id,first_name,last_name')->orderBy('id','desc');

        if ($status) $q->where('status', $status);
        if ($type)   $q->where('leave_type', $type);

        $leaves = $q->paginate(config('constants.pagination_limit'));

        // simple static balances (aap later db se calculate kar sakte ho)
        $balances = [
            'Casual Leave' => 12,
            'Sick Leave' => 7,
            'Earned Leave' => 15,
        ];

        return view('admin.leave.index', compact('employees','leaves','balances','status','type'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'leave_type'  => 'required|string|max:50',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date|after_or_equal:from_date',
            'reason'      => 'required|string',
            'contact_no'  => 'nullable|string|max:20',
        ]);

        $from = \Carbon\Carbon::parse($validated['from_date']);
        $to   = \Carbon\Carbon::parse($validated['to_date']);
        $days = $from->diffInDays($to) + 1;

        LeaveApplication::create([
            'employee_id' => $validated['employee_id'],
            'leave_type'  => $validated['leave_type'],
            'from_date'   => $validated['from_date'],
            'to_date'     => $validated['to_date'],
            'duration_days' => $days,
            'reason'      => $validated['reason'],
            'contact_no'  => $validated['contact_no'] ?? null,
            'status'      => 'Pending',
        ]);

        return redirect()->route('admin.leave.index')->with('success', 'Leave request submitted.');
    }

    // ✅ Approve / Reject / Cancel
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected,Cancelled',
            'action_remark' => 'nullable|string|max:500',
        ]);

        $leave = LeaveApplication::findOrFail($id);

        // Example: prevent approve if already cancelled
        if ($leave->status === 'Cancelled') {
            return back()->with('error', 'This leave is already cancelled.');
        }

        $leave->status = $validated['status'];
        $leave->action_remark = $validated['action_remark'] ?? null;
        $leave->action_by = auth()->id(); // admin id
        $leave->action_at = now();
        $leave->save();

        return back()->with('success', 'Leave status updated.');
    }
}
