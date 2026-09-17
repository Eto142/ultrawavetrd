@csrf
@if (isset($course))
    @method('PUT')
@endif

<div class="mb-3">
    <label class="form-label text-light">Title</label>
    <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}" required class="form-control">
    @error('title') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label text-light">Category</label>
    <select name="course_category_id" required class="form-select">
        <option value="">Select category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('course_category_id', $course->course_category_id ?? null) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('course_category_id') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Price</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $course->price ?? '0.00') }}" required class="form-control">
        @error('price') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Level</label>
        <select name="level" required class="form-select">
            @foreach (['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced'] as $value => $label)
                <option value="{{ $value }}" @selected(old('level', $course->level ?? 'beginner') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('level') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Instructor Name</label>
    <input type="text" name="instructor_name" value="{{ old('instructor_name', $course->instructor_name ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label text-light">Thumbnail URL</label>
    <input type="text" name="thumbnail_url" value="{{ old('thumbnail_url', $course->thumbnail_url ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label text-light">Description</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $course->description ?? '') }}</textarea>
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $course->is_active ?? true)) class="form-check-input">
    <label for="is_active" class="form-check-label text-light">Active (visible to students)</label>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($course) ? 'Save Changes' : 'Create Course' }}</button>
    <a href="{{ route('admin.courses') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
