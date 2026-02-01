@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200">
    <div class="px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-900">Create Project</h1>
    </div>
</div>

<!-- Content -->
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" id="createProjectForm">
                @csrf
                
                <!-- Project Details Section -->
                <div class="space-y-5">
                    <!-- Project Name -->
                    <div class="grid grid-cols-2 gap-5">
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Project Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm" placeholder="Enter project name">
                        </div>

                        <!-- Project Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Project Type</label>
                            <select name="type" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
                                <option value="">Select a project type</option>
                                @foreach($projectTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Project Code -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Project Code</label>
                            <input type="text" name="code" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm" placeholder="e.g., GF-PRK-2025">
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm" placeholder="Enter location">
                        </div>

                        <!-- Client -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Client / Owner</label>
                            <input type="text" name="client" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm" placeholder="Enter client name">
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Expected End Date</label>
                            <input type="date" name="end_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm">
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition text-sm resize-none" placeholder="Enter project description"></textarea>
                        </div>
                    </div>

                    <!-- Upload Image Section -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Image of the Project Here</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-yellow-400 hover:bg-yellow-50/30 transition cursor-pointer" onclick="document.getElementById('imageUpload').click()">
                            <input type="file" id="imageUpload" name="image" accept="image/*" class="hidden">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm text-gray-600">Drag & drop files or <span class="text-yellow-600 font-semibold">Browse</span></p>
                            <p class="text-xs text-gray-500 mt-1">Supported formats: JPG, PNG, GIF</p>
                        </div>
                    </div>

                    <!-- Assign Team Section -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-semibold text-gray-700">Assign Team</label>
                            <button type="button" onclick="addRole()" class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm font-medium flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Role
                            </button>
                        </div>
                        
                        <!-- Roles Display -->
                        <div id="rolesContainer" class="flex flex-wrap gap-2 mb-4">
                            <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium flex items-center gap-2">
                                Project Manager
                                <button type="button" class="hover:bg-gray-200 rounded-full p-0.5 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                            <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium flex items-center gap-2">
                                Site Engineer
                                <button type="button" class="hover:bg-gray-200 rounded-full p-0.5 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        </div>

                        <!-- Team Members Selection -->
                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-700">Select Team Members</span>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input type="text" placeholder="Search" class="pl-9 pr-3 py-1.5 w-48 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500">
                                </div>
                            </div>
                            
                            <div class="max-h-80 overflow-y-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 sticky top-0">
                                        <tr class="text-xs font-semibold text-gray-600 uppercase tracking-wide">
                                            <th class="text-left py-3 px-4 w-12"></th>
                                            <th class="text-left py-3 px-4">Name</th>
                                            <th class="text-left py-3 px-4">Location</th>
                                            <th class="text-left py-3 px-4">Salary</th>
                                            <th class="text-left py-3 px-4">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($teamMembers as $member)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="py-3 px-4">
                                                <input type="checkbox" name="team_members[]" value="{{ $member->id }}" class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-semibold text-xs">
                                                        {{ $member->initials }}
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-900">{{ $member->name }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="px-2.5 py-1 bg-white border border-gray-300 rounded-full text-xs font-medium text-gray-700">{{ $member->location }}</span>
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-900">{{ $member->salary }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-500">{{ $member->role }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('projects.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium text-sm text-gray-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Close
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-medium text-sm shadow-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function addRole() {
    const roles = ['Architect', 'Civil Engineer', 'Safety Officer', 'Foreman', 'Electrician', 'Plumber', 'Construction Worker'];
    const container = document.getElementById('rolesContainer');
    const currentRoles = Array.from(container.querySelectorAll('span')).map(span => span.textContent.trim().split('\n')[0].trim());
    const availableRoles = roles.filter(role => !currentRoles.includes(role));
    
    if (availableRoles.length > 0) {
        const roleSpan = document.createElement('span');
        roleSpan.className = 'px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium flex items-center gap-2';
        roleSpan.innerHTML = `
            ${availableRoles[0]}
            <button type="button" onclick="this.parentElement.remove()" class="hover:bg-gray-200 rounded-full p-0.5 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        container.appendChild(roleSpan);
    }
}
</script>
@endsection