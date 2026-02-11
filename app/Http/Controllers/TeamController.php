<?php

namespace App\Http\Controllers;
use App\Models\TeamMemberUpdateRequest;
use App\Models\TeamMember;
use App\Models\Project;
use App\Models\AttendanceRecord;
use App\Models\VerificationHistory;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::all();
        $projects = Project::all();
        $verificationHistory = VerificationHistory::with('teamMember')->latest()->take(7)->get();
        $attendanceRecords = AttendanceRecord::with(['teamMember', 'document'])->where('status', 'pending')->get();
        
        return view('team.index', compact('teamMembers', 'projects', 'verificationHistory', 'attendanceRecords'));
    }

    public function documents(Request $request)
    {
        $teamMembers = TeamMember::with(['documents', 'pendingUpdateRequest'])->orderBy('name')->get();

        return view('team.documents', compact('teamMembers'));
    }

    public function payroll()
    {
        $teamMembers = TeamMember::with('payrollRecords')->get();
        
        return view('team.payroll', compact('teamMembers'));
    }

    public function assign()
    {
        $projects = Project::with('teamMembers')->get();
        $teamMembers = TeamMember::all();
        
        return view('team.assign', compact('projects', 'teamMembers'));
    }

    public function attendance()
    {
        $attendanceRecords = AttendanceRecord::with(['teamMember', 'document'])->where('status', 'pending')->get();
        
        return view('team.attendance', compact('attendanceRecords'));
    }

    public function approveAttendance(Request $request, $id)
    {
        $attendance = AttendanceRecord::findOrFail($id);
        $attendance->update(['status' => 'verified']);
        
        VerificationHistory::create([
            'team_member_id' => $attendance->team_member_id,
            'status' => 'Verified',
            'date_submitted' => $attendance->date,
            'date_checked' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Attendance approved');
    }

    public function rejectAttendance(Request $request, $id)
    {
        $validated = $request->validate([
            'remarks' => 'required|string',
        ]);

        $attendance = AttendanceRecord::findOrFail($id);
        $attendance->update([
            'status' => 'denied',
            'remarks' => $validated['remarks'],
        ]);
        
        VerificationHistory::create([
            'team_member_id' => $attendance->team_member_id,
            'status' => 'Denied',
            'date_submitted' => $attendance->date,
            'date_checked' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Attendance rejected');
    }

    public function assignToProject(Request $request, $projectId)
{
    $validated = $request->validate([
        'team_members' => 'required|array|min:1',
        'team_members.*' => 'integer|exists:team_members,id',
        // optional: lets us “replace” vs “add”
        'mode' => 'nullable|in:replace,add',
    ]);

    $project = Project::findOrFail($projectId);

    // Default: replace assigned members for that project
    if (($validated['mode'] ?? 'replace') === 'add') {
        $project->teamMembers()->syncWithoutDetaching($validated['team_members']);
    } else {
        $project->teamMembers()->sync($validated['team_members']);
    }

    return redirect()->back()->with('success', 'Team members assigned successfully');
}


    public function listMembers(Request $request)
    {
        $search = $request->query('search');

        $q = TeamMember::query()
            ->select('id', 'name', 'location', 'salary', 'role', 'avatar');

        if ($search) {
            $q->where(function ($w) use ($search) {
                $w->where('name', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
            });
        }

        return response()->json(
            $q->orderBy('name')->limit(200)->get()
        );
    }

    public function approveUpdateRequest($id)
    {
        $req = TeamMemberUpdateRequest::with('teamMember')->findOrFail($id);

        // apply changes to the team member
        $req->teamMember->update($req->changes);

        $req->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'remarks' => null,
        ]);

        return redirect()->back()->with('success', 'Update request approved');
    }

    public function rejectUpdateRequest(Request $request, $id)
    {
        $data = $request->validate([
            'remarks' => 'required|string',
        ]);

        $req = TeamMemberUpdateRequest::findOrFail($id);

        $req->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'remarks' => $data['remarks'],
        ]);

        return redirect()->back()->with('success', 'Update request rejected');
    }



}