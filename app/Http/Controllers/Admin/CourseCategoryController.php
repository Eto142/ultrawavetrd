<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::withCount('courses')->latest()->paginate(20);

        return view('admin.course-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.course-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        CourseCategory::create($validated);

        return redirect()->route('admin.course-categories')->with('success', 'Category created.');
    }

    public function edit(CourseCategory $courseCategory)
    {
        return view('admin.course-categories.edit', ['category' => $courseCategory]);
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $courseCategory->update($validated);

        return redirect()->route('admin.course-categories')->with('success', 'Category updated.');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();

        return back()->with('success', 'Category removed.');
    }
}
