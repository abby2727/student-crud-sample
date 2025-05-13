<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher', 'students')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'teacher_id' => 'required|exists:teachers,id',
        ]);
        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created!');
    }

    public function edit(Course $course)
    {
        $teachers = Teacher::all();
        $students = Student::all();
        $course->load('students');
        return view('courses.edit', compact('course', 'teachers', 'students'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'teacher_id' => 'required|exists:teachers,id',
        ]);
        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated!');
    }

    public function destroy(Course $course)
    {
        $course->students()->detach();
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted!');
    }

    // Assign/unassign students to course
    public function updateStudents(Request $request, Course $course)
    {
        $course->students()->sync($request->students ?? []);
        return back()->with('success', 'Enrolled students updated!');
    }
}
