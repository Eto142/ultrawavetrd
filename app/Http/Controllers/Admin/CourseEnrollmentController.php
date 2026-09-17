<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CourseEnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $enrollments = CourseEnrollment::with(['user', 'course'])
            ->when($request->filled('course'), fn ($q) => $q->where('course_id', $request->integer('course')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->integer('status')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.course-enrollments.index', compact('enrollments'));
    }

    public function approve(CourseEnrollment $enrollment)
    {
        $enrollment->update(['status' => CourseEnrollment::STATUS_APPROVED]);

        $price = (float) ($enrollment->course->price ?? 0);

        if ($price > 0) {
            Transaction::record(
                user: $enrollment->user,
                type: Transaction::TYPE_DEBIT,
                category: 'course',
                amount: $price,
                reference: $enrollment,
                description: $enrollment->course->title ?? 'Course enrollment',
            );
        }

        return back()->with('success', 'Enrollment approved.');
    }
}
