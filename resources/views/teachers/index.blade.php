@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
        <h2 class="text-2xl font-bold">Teachers</h2>
        <a href="{{ route('teachers.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Add Teacher</a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department
                    </th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Courses
                    </th>
                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($teachers as $teacher)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-2 px-4 whitespace-nowrap">
                            <a href="{{ route('teachers.show', $teacher) }}" class="text-green-700 hover:underline">
                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                            </a>
                        </td>
                        <td class="py-2 px-4 whitespace-nowrap">{{ $teacher->email }}</td>
                        <td class="py-2 px-4 whitespace-nowrap">{{ $teacher->department }}</td>
                        <td class="py-2 px-4 whitespace-nowrap">
                            @if ($teacher->courses->isEmpty())
                                <span class="text-gray-400 italic">No courses</span>
                            @else
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($teacher->courses as $course)
                                        <span
                                            class="inline-block bg-green-100 text-green-800 rounded px-2 py-1 text-xs font-medium">{{ $course->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="py-2 px-4 whitespace-nowrap flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('teachers.edit', $teacher) }}" class="text-green-700 hover:underline">Edit</a>
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
    </div>
@endsection
