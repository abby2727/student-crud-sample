@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Students</h2>
        <a href="{{ route('students.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add
            Student</a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">DOB</th>
                <th class="py-2 px-4 border-b">Courses</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $student->email }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') }}
                    </td>
                    <td class="py-2 px-4 border-b">
                        @if ($student->courses->isEmpty())
                            <span class="text-gray-400 italic">Empty course</span>
                        @else
                            @foreach ($student->courses as $course)
                                <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs">{{ $course->name }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b flex gap-2">
                        <a href="{{ route('students.edit', $student) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST"
                            onsubmit="return confirm('Delete this student?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                        <form action="{{ route('students.updateCourses', $student) }}" method="POST">
                            @csrf
                            <select name="courses[]" multiple class="border rounded px-2 py-1 text-xs"
                                onchange="this.form.submit()">
                                @foreach (\App\Models\Course::all() as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $student->courses->contains($course->id) ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
