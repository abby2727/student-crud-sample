@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Courses</h2>
        <a href="{{ route('courses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
            Course</a>
    </div>
    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Teacher</th>
                <th class="py-2 px-4 border-b">Students</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $course->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $course->teacher?->first_name }} {{ $course->teacher?->last_name }}
                    </td>
                    <td class="py-2 px-4 border-b">
                        @if ($course->students->isEmpty())
                            <span class="text-gray-400 italic">No students</span>
                        @else
                            @foreach ($course->students as $student)
                                <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs">{{ $student->first_name }}
                                    {{ $student->last_name }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b flex gap-2">
                        <a href="{{ route('courses.edit', $course) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST"
                            onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
