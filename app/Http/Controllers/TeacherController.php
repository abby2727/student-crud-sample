<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('courses')->get();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'department' => 'required',
        ]);
        Teacher::create($validated);
        return redirect()->route('teachers.index')->with('success', 'Teacher created!');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'department' => 'required',
        ]);
        $teacher->update($validated);
        return redirect()->route('teachers.index')->with('success', 'Teacher updated!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted!');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('courses');
        return view('teachers.show', compact('teacher'));
    }
}
