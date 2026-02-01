@extends('layouts.app')

@section('content')
<div class="sticky top-0 z-40 bg-white border-b">
    <div class="px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold">Project Assignment</h1>
        <a href="{{ route('team.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Back to Team
        </a>
    </div>
</div>

<div class="p-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-4">Assign Team to Projects</h2>
        <p class="text-gray-600">Team assignment feature coming soon...</p>
    </div>
</div>
@endsection