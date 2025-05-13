@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">
        {{ $teacher->first_name }} {{ $teacher->last_name }}'s Courses
    </h2>
    <ul>
        @forelse($teacher->courses as $course)
            <li class="mb-2">{{ $course->name }}</li>
        @empty
            <li class="text-gray-400 italic">No courses assigned.</li>
        @endforelse
    </ul>
    <a href="{{ route('teachers.index') }}" class="mt-4 inline-block text-gray-600 hover:underline">Back to Teachers</a>
@endsection
