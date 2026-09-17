<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->withCount('enrollments')->latest()->paginate(20);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = CourseCategory::orderBy('name')->get();

        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active');

        Course::create($validated);

        return redirect()->route('admin.courses')->with('success', 'Course created.');
    }

    public function edit(Course $course)
    {
        $categories = CourseCategory::orderBy('name')->get();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active');

        $course->update($validated);

        return redirect()->route('admin.courses')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Course removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'course_category_id' => ['required', 'exists:course_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'thumbnail_url' => ['nullable', 'string', 'max:2048'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'level' => ['required', 'string', 'max:50'],
            'instructor_name' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
