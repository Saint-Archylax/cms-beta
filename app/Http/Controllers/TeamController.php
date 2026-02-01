<?php

namespace App\Http\Controllers;

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

    public function documents()
    {
        $teamMembers = TeamMember::with('documents')->get();
        
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
            'team_members' => 'required|array',
        ]);

        $project = Project::findOrFail($projectId);
        $project->teamMembers()->syncWithoutDetaching($validated['team_members']);
        
        return redirect()->back()->with('success', 'Team members assigned successfully');
    }
}