@csrf
@if (isset($lesson))
    @method('PUT')
@endif

<div class="mb-3">
    <label class="form-label text-light">Title</label>
    <input type="text" name="title" value="{{ old('title', $lesson->title ?? '') }}" required class="form-control">
    @error('title') <div class="text-loss small mt-1">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Duration</label>
        <input type="text" name="duration" placeholder="e.g. 12:30" value="{{ old('duration', $lesson->duration ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label text-light">Sort Order</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $lesson->sort_order ?? 0) }}" required class="form-control">
    </div>
</div>
<div class="mb-3">
    <label class="form-label text-light">Video URL</label>
    <input type="text" name="video_url" value="{{ old('video_url', $lesson->video_url ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label text-light">Description</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $lesson->description ?? '') }}</textarea>
</div>
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ isset($lesson) ? 'Save Changes' : 'Add Lesson' }}</button>
    <a href="{{ route('admin.lessons', $course) }}" class="btn btn-outline-secondary">Cancel</a>
</div>
