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
                        <!-- Assign Courses Button -->
                        <button class="bg-gray-200 text-gray-800 px-2 py-1 rounded hover:bg-blue-100"
                            onclick="openModal({{ $student->id }})" type="button">
                            Assign Courses
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div id="assignCoursesModal" class="fixed inset-0 z-50 hidden">
        <!-- Overlay -->
        <div class="absolute inset-0" onclick="closeModal()"></div>
        <!-- Modal Content -->
        <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md p-6 mx-auto my-20 z-10 flex flex-col">
            <h3 class="text-xl font-bold mb-4">Assign Courses</h3>
            <form id="assignCoursesForm" method="POST">
                @csrf
                <div id="coursesCheckboxes" class="mb-4 max-h-60 overflow-y-auto">
                    <!-- Checkboxes will be injected here -->
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
                </div>
            </form>
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
    </div>

    <script>
        // Prepare student-course data for JS
        const studentsCourses = @json($students->mapWithKeys(fn($s) => [$s->id => $s->courses->pluck('id')]));
        const allCourses = @json(\App\Models\Course::all(['id', 'name']));

        let currentStudentId = null;

        function openModal(studentId) {
            currentStudentId = studentId;
            const modal = document.getElementById('assignCoursesModal');
            const form = document.getElementById('assignCoursesForm');
            const checkboxesDiv = document.getElementById('coursesCheckboxes');

            // Set form action
            form.action = `/students/${studentId}/courses`;

            // Clear previous checkboxes
            checkboxesDiv.innerHTML = '';

            // Get current student's courses
            const selectedCourses = studentsCourses[studentId] || [];

            // Render checkboxes
            allCourses.forEach(course => {
                const checked = selectedCourses.includes(course.id) ? 'checked' : '';
                checkboxesDiv.innerHTML += `
                    <div class="mb-2 flex items-center">
                        <input type="checkbox" name="courses[]" value="${course.id}" id="course_${course.id}" class="mr-2" ${checked}>
                        <label for="course_${course.id}">${course.name}</label>
                    </div>
                `;
            });

            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('assignCoursesModal').classList.add('hidden');
            currentStudentId = null;
        }

        // Optional: Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });
    </script>
@endsection
