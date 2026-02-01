@extends('layouts.app')

@section('content')
<!-- Header with Search -->
<div class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200">
    <div class="px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Project Management</h1>
        </div>
        <div class="flex items-center gap-4">
            <button class="px-4 py-2.5 bg-yellow-600 text-white rounded-lg hover:bg--700 flex items-center gap-2 font-medium shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Generate Report
            </button>
            <form method="GET" action="{{ route('projects.index') }}" class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="pl-10 pr-4 py-2 w-64 bg-gray-100 border-0 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:bg-white transition">
            </form>
        </div>
    </div>
</div>

<!-- Projects Grid -->
<div class="p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
        @foreach($projects as $project)
        <div class="project-card group relative rounded-xl overflow-hidden cursor-pointer transition-all duration-300 bg-white border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1" onclick="window.location.href='{{ route('projects.show', $project->id) }}'">
            <!-- Project Image -->
            <div class="relative h-32 overflow-hidden bg-gray-200">
                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                <div class="w-full h-full bg-gradient-to-br from-yellow-500 to-yellow-600"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                
                @if($project->status === 'completed')
                <div class="absolute top-2 right-2 px-2.5 py-1 bg-green-600 text-white text-xs rounded-full font-medium flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Completed
                </div>
                @endif
            </div>
            
            <!-- Project Info -->
            <div class="p-4">
                <h3 class="font-semibold text-sm text-gray-900 truncate group-hover:text-yellow-600 transition">{{ $project->name }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">{{ $project->type }}</p>
                
                @if($project->status !== 'completed')
                <div class="mt-3">
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="text-gray-500 font-medium">Progress</span>
                        <span class="font-semibold text-gray-900">{{ $project->progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div class="bg-yellow-600 h-2 rounded-full transition-all duration-500" style="width: {{ $project->progress }}%"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
        
        <!-- Create Project Card -->
        <div class="create-card group relative rounded-xl border-2 border-dashed border-gray-300 cursor-pointer transition-all duration-300 h-[240px] flex flex-col items-center justify-center gap-3 bg-gray-50/50 hover:border-yellow-400 hover:bg-yellow-50 hover:-translate-y-1 hover:shadow-lg" onclick="window.location.href='{{ route('projects.create') }}'">
            <div class="w-14 h-14 rounded-full bg-gray-300 flex items-center justify-center transition-all duration-300 group-hover:bg-yellow-400 group-hover:scale-110">
                <svg class="w-7 h-7 text-gray-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <span class="font-semibold text-sm text-gray-600 group-hover:text-yellow-600 transition uppercase tracking-wide">Create Project</span>
        </div>
    </div>
</div>

<style>
    .project-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection