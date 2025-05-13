<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'courses' => 'array'
        ]);

        $student = Student::create($validated);
        if ($request->has('courses')) {
            $student->courses()->sync($request->courses);
        }

        return redirect()->route('students.index')->with('success', 'Student created!');
    }

    public function edit(Student $student)
    {
        $courses = Course::all();
        $student->load('courses');
        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'courses' => 'array'
        ]);

        $student->update($validated);
        if ($request->has('courses')) {
            $student->courses()->sync($request->courses);
        } else {
            $student->courses()->detach();
        }

        return redirect()->route('students.index')->with('success', 'Student updated!');
    }

    public function destroy(Student $student)
    {
        $student->courses()->detach();
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted!');
    }

    // Assign/unassign courses
    public function updateCourses(Request $request, Student $student)
    {
        $student->courses()->sync($request->courses ?? []);
        return back()->with('success', 'Courses updated!');
    }
}
