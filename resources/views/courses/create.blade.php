@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add Course</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Course Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Teacher</label>
            <select name="teacher_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Teacher</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->first_name }} {{ $teacher->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('courses.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
