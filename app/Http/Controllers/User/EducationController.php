<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->withCount('lessons')
            ->withCount(['enrollments as enrolled_count' => function ($query) {
                $query->where('status', CourseEnrollment::STATUS_APPROVED);
            }])
            ->latest()
            ->get();

        $categories = CourseCategory::with('standaloneLessons')->get()->filter(fn ($category) => $category->standaloneLessons->isNotEmpty());

        return view('user.courses', compact('courses', 'categories'));
    }

    public function myCourses(Request $request)
    {
        $enrollments = $request->user()->courseEnrollments()->with('course')->latest()->get();

        return view('user.my-courses', compact('enrollments'));
    }

    public function show(Course $course)
    {
        $course->load('category', 'lessons');

        $enrollment = auth()->user()
            ? $course->enrollments()->where('user_id', auth()->id())->first()
            : null;

        return view('user.course-show', compact('course', 'enrollment'));
    }

    public function enroll(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $course = Course::findOrFail($validated['course_id']);

        $existing = $request->user()->courseEnrollments()->where('course_id', $course->id)->first();

        if ($existing) {
            return back()->with('error', "You've already requested \"{$course->title}\".");
        }

        $request->user()->courseEnrollments()->create([
            'course_id' => $course->id,
            'status' => $course->isFree() ? CourseEnrollment::STATUS_APPROVED : CourseEnrollment::STATUS_PENDING,
            'progress_percent' => 0,
        ]);

        $message = $course->isFree()
            ? "You're enrolled in \"{$course->title}\"."
            : "Your purchase request for \"{$course->title}\" has been submitted and is pending approval.";

        return redirect()->route('user.my-courses')->with('success', $message);
    }
}
