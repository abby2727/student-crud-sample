@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Teachers</h2>
        <a href="{{ route('teachers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
            Teacher</a>
    </div>
    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Department</th>
                <th class="py-2 px-4 border-b">Courses</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('teachers.show', $teacher) }}" class="text-blue-600 hover:underline">
                            {{ $teacher->first_name }} {{ $teacher->last_name }}
                        </a>
                    </td>
                    <td class="py-2 px-4 border-b">{{ $teacher->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $teacher->department }}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($teacher->courses->isEmpty())
                            <span class="text-gray-400 italic">No courses</span>
                        @else
                            @foreach ($teacher->courses as $course)
                                <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs">{{ $course->name }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b flex gap-2">
                        <a href="{{ route('teachers.edit', $teacher) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST"
                            onsubmit="return confirm('Delete this teacher?')">
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
