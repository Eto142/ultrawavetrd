<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $lessons = $course->lessons()->paginate(50);

        return view('admin.lessons.index', compact('course', 'lessons'));
    }

    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $this->validated($request);
        $validated['course_id'] = $course->id;

        Lesson::create($validated);

        return redirect()->route('admin.lessons', $course)->with('success', 'Lesson added.');
    }

    public function edit(Lesson $lesson)
    {
        $course = $lesson->course;

        return view('admin.lessons.edit', compact('lesson', 'course'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $lesson->update($this->validated($request));

        return redirect()->route('admin.lessons', $lesson->course_id)->with('success', 'Lesson updated.');
    }

    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();

        return redirect()->route('admin.lessons', $courseId)->with('success', 'Lesson removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:50'],
            'video_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }
}
