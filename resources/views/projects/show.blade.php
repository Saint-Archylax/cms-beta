@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto">

        <!--card-->
        <div class="relative overflow-hidden rounded-2xl shadow-2xl border border-gray-800 bg-[#3f3f3f]">

            <!--Decorative circles-->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-500/20 rounded-full"></div>
            <div class="absolute top-6 right-10 w-20 h-20 bg-yellow-500/25 rounded-full"></div>

            <div class="grid grid-cols-1 md:grid-cols-5">

                <!--LEFT PANEL-->
                <div class="md:col-span-2 bg-yellow-500/25 p-5 text-white relative ">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="text-xs text-yellow-300/90 font-semibold tracking-wide">PROJECT DETAILS</div>
                            <h1 class="text-2xl font-bold tracking-wide mt-1">{{ $project->name }}</h1>
                        </div>

                        <a href="{{ route('projects.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-500 text-black font-semibold hover:bg-orange-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>
                            Back
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="mt-6 rounded-xl overflow-hidden border border-white/10">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}"
                                 alt="{{ $project->name }}"
                                 class="w-full h-52 object-cover">
                        @else
                            <div class="w-full h-52 bg-gradient-to-br from-yellow-500 to-yellow-600"></div>
                        @endif
                    </div>

                    <!-- Assigned Team -->
                    <div class="bg-[#3f3f3f] rounded-2xl shadow-2xl border border-gray-800 overflow-hidden mt-6">
                    <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
                        <h4 class="text-white font-semibold">Assigned Team</h4>
                        <span class="text-xs text-white/60">{{ $project->teamMembers->count() }} member(s)</span>
                    </div>

                    <!-- ONLY TABLE SCROLLS -->
                    <div class="max-h-80 overflow-y-auto">
                        <table class="w-full text-left">
                            <thead class="sticky top-0 bg-[#3f3f3f] border-b border-white/10">
                                <tr class="text-[11px] uppercase tracking-wide text-white/60">
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3 w-32">Role</th>
                                    <th class="px-6 py-3 w-28">Location</th>
                                    <th class="px-6 py-3 w-24">Rate</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-white/10">
                                @forelse($project->teamMembers as $member)
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-lg bg-black/30 border border-white/10 flex items-center justify-center text-xs font-bold text-yellow-300">
                                                    {{ strtoupper(collect(explode(' ', $member->name))->filter()->take(2)->map(fn($w)=>substr($w,0,1))->join('')) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-white">{{ $member->name }}</div>
                                                    <div class="text-xs text-white/50">{{ $member->role }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-3 text-sm text-white/80">{{ $member->role ?? '-' }}</td>
                                        <td class="px-6 py-3 text-sm text-white/80">{{ $member->location ?? '-' }}</td>
                                        <td class="px-6 py-3 text-sm text-white/80">{{ $member->salary ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-white/50 text-sm">
                                            No assigned members yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>

                <!-- RIGHT PANEL -->
                <div class="md:col-span-3 p-10 text-white">
                    <h2 class="text-lg font-semibold mb-6">Project Information</h2>

                    <div class="space-y-7">

                        <!-- Two columns info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            <div>
                                <label class="text-sm font-semibold text-white/90">Project Code</label>
                                <div class="mt-2 w-full bg-transparent border-b border-white/20 py-2 text-sm text-white/90">
                                    {{ $project->code }}
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-white/90">Project Type</label>
                                <div class="mt-2 w-full bg-transparent border-b border-white/20 py-2 text-sm text-white/90">
                                    {{ $project->type }}
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-white/90">Client / Owner</label>
                                <div class="mt-2 w-full bg-transparent border-b border-white/20 py-2 text-sm text-white/90">
                                    {{ $project->client }}
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-white/90">Location</label>
                                <div class="mt-2 w-full bg-transparent border-b border-white/20 py-2 text-sm text-white/90">
                                    {{ $project->location }}
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-white/90">Start Date</label>
                                <div class="mt-2 w-full bg-transparent border-b border-white/20 py-2 text-sm text-white/90">
                                    {{ optional($project->start_date)->format('F d, Y') ?? '-' }}
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-white/90">Expected End Date</label>
                                <div class="mt-2 w-full bg-transparent border-b border-white/20 py-2 text-sm text-white/90">
                                    {{ optional($project->end_date)->format('F d, Y') ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="text-sm font-semibold text-white/90">Description</label>
                            <div class="mt-2 w-full bg-transparent border border-white/15 rounded-lg p-4 text-sm text-white/80">
                                {{ $project->description }}
                            </div>
                        </div>

                        <!-- Status + Progress -->
                        <div class="flex flex-wrap items-center gap-4">
                            <div class="px-4 py-2 rounded-lg bg-black/30 border border-white/10">
                                <span class="text-xs text-white/60">Status:</span>
                                <span class="ml-2 text-sm font-semibold text-white">
                                    {{ ucfirst($project->status ?? 'pending') }}
                                </span>
                            </div>

                            <div class="px-4 py-2 rounded-lg bg-black/30 border border-white/10">
                                <span class="text-xs text-white/60">Progress:</span>
                                <span class="ml-2 text-sm font-semibold text-yellow-300">
                                    {{ $project->progress ?? 0 }}%
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
