<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('teamMembers');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }
        
        $projects = $query->get();
        
        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with('teamMembers')->findOrFail($id);
        
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        $teamMembers = TeamMember::all();
        $projectTypes = [
            'Park Project',
            'House Project',
            'Bridge Project',
            'Factory Project',
            'Building Project',
            'Road Project',
            'Bus Terminal Project'
        ];
        
        return view('projects.create', compact('teamMembers', 'projectTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'code' => 'required|string|unique:projects',
            'location' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'client' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'team_members' => 'array',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['status'] = 'pending';
        $validated['progress'] = 0;

        $project = Project::create($validated);

        if ($request->has('team_members')) {
            $project->teamMembers()->attach($request->team_members);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|in:ongoing,completed,pending',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'client' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $project->update($validated);

        if ($request->has('team_members')) {
            $project->teamMembers()->sync($request->team_members);
        }

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}