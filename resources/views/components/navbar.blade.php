@php
    $current = '';
    if (request()->routeIs('students.*')) {
        $current = 'students';
    } elseif (request()->is('dashboard')) {
        $current = 'dashboard';
    } elseif (request()->is('teachers')) {
        $current = 'teachers';
    } elseif (request()->is('courses')) {
        $current = 'courses';
    }
@endphp

<nav class="w-full max-w-4xl mb-8">
    <ul class="flex justify-center gap-8 bg-white dark:bg-[#161615] rounded-lg shadow-md py-4">
        <li>
            <a href="/dashboard"
                class="font-medium transition px-2 py-1 rounded
                   {{ $current === 'dashboard' ? 'bg-blue-600 text-white' : 'text-[#1b1b18] dark:text-[#EDEDEC] hover:text-red-600' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('students.index') }}"
                class="font-medium transition px-2 py-1 rounded
                   {{ $current === 'students' ? 'bg-blue-600 text-white' : 'text-[#1b1b18] dark:text-[#EDEDEC] hover:text-red-600' }}">
                Students
            </a>
        </li>
        <li>
            <a href="/teachers"
                class="font-medium transition px-2 py-1 rounded
                   {{ $current === 'teachers' ? 'bg-blue-600 text-white' : 'text-[#1b1b18] dark:text-[#EDEDEC] hover:text-red-600' }}">
                Teachers
            </a>
        </li>
        <li>
            <a href="/courses"
                class="font-medium transition px-2 py-1 rounded
                   {{ $current === 'courses' ? 'bg-blue-600 text-white' : 'text-[#1b1b18] dark:text-[#EDEDEC] hover:text-red-600' }}">
                Courses
            </a>
        </li>
    </ul>
</nav>
