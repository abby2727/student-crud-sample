@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Teacher</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.update', $teacher) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name', $teacher->first_name) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name', $teacher->last_name) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $teacher->email) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Department</label>
            <input type="text" name="department" value="{{ old('department', $teacher->department) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('teachers.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
