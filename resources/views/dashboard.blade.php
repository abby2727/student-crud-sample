@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Laravel Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Students Card -->
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">
                {{ \App\Models\Student::count() }}
            </div>
            <div class="text-lg font-semibold mb-2">Students</div>
            <a href="{{ route('students.index') }}" class="text-blue-600 hover:underline">Manage Students</a>
        </div>
        <!-- Teachers Card -->
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-4xl font-bold text-green-600 mb-2">
                {{ \App\Models\Teacher::count() }}
            </div>
            <div class="text-lg font-semibold mb-2">Teachers</div>
            <a href="{{ route('teachers.index') }}" class="text-green-600 hover:underline">Manage Teachers</a>
        </div>
        <!-- Courses Card -->
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-4xl font-bold text-purple-600 mb-2">
                {{ \App\Models\Course::count() }}
            </div>
            <div class="text-lg font-semibold mb-2">Courses</div>
            <a href="{{ route('courses.index') }}" class="text-purple-600 hover:underline">Manage Courses</a>
        </div>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Quick Links</h2>
        <ul class="list-disc list-inside space-y-2">
            <li><a href="{{ route('students.create') }}" class="text-blue-600 hover:underline">Add New Student</a></li>
            <li><a href="{{ route('teachers.create') }}" class="text-green-600 hover:underline">Add New Teacher</a></li>
            <li><a href="{{ route('courses.create') }}" class="text-purple-600 hover:underline">Add New Course</a></li>
        </ul>
    </div>
@endsection
