@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
        <h2 class="text-2xl font-bold">Courses</h2>
        <a href="{{ route('courses.create') }}"
            class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">Add Course</a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Teacher</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Students
                    </th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($courses as $course)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-2 px-4 whitespace-nowrap">{{ $course->name }}</td>
                        <td class="py-2 px-4 whitespace-nowrap">
                            {{ $course->teacher ? $course->teacher->first_name . ' ' . $course->teacher->last_name : '-' }}
                        </td>
                        <td class="py-2 px-4 whitespace-nowrap">
                            @if ($course->students->isEmpty())
                                <span class="text-gray-400 italic">No students</span>
                            @else
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($course->students as $student)
                                        <span
                                            class="inline-block bg-purple-100 text-purple-800 rounded px-2 py-1 text-xs font-medium">{{ $student->first_name }}
                                            {{ $student->last_name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="py-2 px-4 whitespace-nowrap flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('courses.edit', $course) }}" class="text-purple-700 hover:underline">Edit</a>
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
    </div>
@endsection
