@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Course</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg mb-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Course Name</label>
            <input type="text" name="name" value="{{ old('name', $course->name) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $course->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Teacher</label>
            <select name="teacher_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->first_name }} {{ $teacher->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('courses.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>

    <form action="{{ route('courses.updateStudents', $course) }}" method="POST"
        class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Enrolled Students</label>
            <select name="students[]" multiple class="w-full border rounded px-3 py-2">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $course->students->contains($student->id) ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Students</button>
    </form>
@endsection
