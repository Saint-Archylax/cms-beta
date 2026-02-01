@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200">
    <div class="px-6 py-4 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 bg-yellow-50 text-yellow-700 text-xs rounded-md font-medium border border-yellow-200">Project Details</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $project->name }}</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-medium shadow-sm transition">
                Back to Projects
            </a>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-6">
    <div class="flex gap-6">
        <!-- Left Column -->
        <div class="flex-1 space-y-6">
            <!-- Description -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-gray-600 leading-relaxed">{{ $project->description }}</p>
            </div>

            <!-- Project Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Project Code</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $project->code }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Project Type</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $project->type }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Client / Owner</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $project->client }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Location</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $project->location }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assigned Team -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Assigned Team</h4>
                <div class="space-y-2 max-h-80 overflow-y-auto">
                    @foreach($project->teamMembers as $member)
                    <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-semibold text-sm">
                                {{ $member->initials }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $member->name }}</p>
                                <p class="text-xs text-gray-500">{{ $member->role }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-white border border-gray-300 rounded-full text-xs font-medium text-gray-700">{{ $member->location }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="w-80 space-y-6">
            <!-- Project Image -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-yellow-500 to-yellow-600"></div>
                @endif
            </div>

            <!-- Timeframe -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Timeframe</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Start Date</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $project->start_date->format('F d, Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Target Completion Date</p>
                            <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $project->end_date->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Status</h4>
                <div class="flex items-center gap-6">
                    <!-- Circular Progress -->
                    <div class="relative w-20 h-20">
                        <svg class="w-20 h-20 transform -rotate-90">
                            <circle cx="40" cy="40" r="36" fill="none" stroke="#e5e7eb" stroke-width="8" />
                            <circle cx="40" cy="40" r="36" fill="none" stroke="#2563eb" stroke-width="8" 
                                    stroke-dasharray="{{ $project->progress * 2.26 }} 226" 
                                    stroke-linecap="round" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold text-gray-900">{{ $project->progress }}%</span>
                        </div>
                    </div>
                    
                    <div>
                        @if($project->status === 'completed')
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Completed</span>
                        @elseif($project->status === 'ongoing')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Ongoing</span>
                        @else
                        <span class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection