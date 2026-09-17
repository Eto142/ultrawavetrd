@include('user.header')

    <main class="transition-all duration-200 lg:ml-64 pt-16 min-h-screen">

        <div x-data="{ toasts: [] }"
             x-init="
                @if (session('success'))
                    toasts.push({ id: Date.now(), message: @js(session('success')), type: 'success' });
                @endif
                @if (session('error'))
                    toasts.push({ id: Date.now() + 1, message: @js(session('error')), type: 'error' });
                @endif
             "
             class="fixed top-20 right-4 z-50 space-y-2 w-80">
            <template x-for="toast in toasts" :key="toast.id">
                <div x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="translate-x-full opacity-0"
                     x-transition:enter-end="translate-x-0 opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="translate-x-0 opacity-100"
                     x-transition:leave-end="translate-x-full opacity-0"
                     :class="{
                        'bg-gain/10 border-gain/20 text-gain': toast.type === 'success',
                        'bg-loss/10 border-loss/20 text-loss': toast.type === 'error',
                        'bg-warning/10 border-warning/20 text-warning': toast.type === 'warning',
                     }"
                     class="border rounded-lg p-4 flex items-start gap-3 shadow-lg backdrop-blur-sm">
                    <span x-text="toast.message" class="text-sm flex-1"></span>
                    <button @click="toasts = toasts.filter(t => t.id !== toast.id)" class="shrink-0 opacity-60 hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
                    </button>
                </div>
            </template>
        </div>

        <div class="p-4 lg:p-6 space-y-6">

    <div class="mb-4">
        <a href="{{ route('user.courses') }}" class="inline-flex items-center gap-1 text-sm text-content-tertiary hover:text-content-primary transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            Back to Courses
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $course->thumbnail_url ?? 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600' }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                </div>
            </div>

            <div>
                <div class="flex items-center gap-2 flex-wrap mb-2">
                    @if ($course->category)
                        <span class="bg-primary/10 text-primary text-xs font-medium px-2 py-0.5 rounded">{{ $course->category->name }}</span>
                    @endif
                    <span class="bg-surface-overlay text-content-secondary text-xs font-medium px-2 py-0.5 rounded">{{ $course->level }}</span>
                </div>
                <h1 class="text-xl font-bold text-content-primary">{{ $course->title }}</h1>
                <div class="flex items-center gap-4 mt-2 text-sm text-content-tertiary">
                    @if ($course->instructor_name)
                        <span>By {{ $course->instructor_name }}</span>
                    @endif
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
</svg>
                        {{ $course->lessons->count() }} Lessons
                    </span>
                </div>
            </div>

            @if ($course->description)
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <h3 class="text-sm font-semibold text-content-primary mb-2">About This Course</h3>
                    <p class="text-sm text-content-secondary leading-relaxed">{{ $course->description }}</p>
                </div>
            @endif

            @if ($course->lessons->isNotEmpty())
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <h3 class="text-sm font-semibold text-content-primary mb-3">Curriculum</h3>
                    <div class="space-y-2">
                        @foreach ($course->lessons as $index => $lesson)
                            <div class="flex items-center justify-between px-4 py-3 rounded-lg bg-surface-overlay border border-surface-border">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="w-7 h-7 rounded-full bg-primary/10 text-primary text-xs font-semibold flex items-center justify-center flex-shrink-0">{{ $index + 1 }}</span>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-content-primary truncate">{{ $lesson->title }}</p>
                                        @if ($lesson->description)
                                            <p class="text-xs text-content-tertiary mt-0.5 truncate">{{ $lesson->description }}</p>
                                        @endif
                                    </div>
                                </div>
                                @if ($lesson->duration)
                                    <span class="text-xs text-content-tertiary flex-shrink-0 ml-3">{{ $lesson->duration }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6 lg:sticky lg:top-20">
                <p class="text-2xl font-bold {{ $course->isFree() ? 'text-gain' : 'text-content-primary' }} mb-4">
                    {{ $course->isFree() ? 'Free' : '$' . number_format($course->price, 2) }}
                </p>

                @if ($enrollment)
                    @if ($enrollment->isActive())
                        <div class="mb-4">
                            <div class="flex items-center justify-between text-xs text-content-tertiary mb-1">
                                <span>Your Progress</span>
                                <span>{{ $enrollment->progress_percent }}%</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-surface-overlay overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: {{ $enrollment->progress_percent }}%"></div>
                            </div>
                        </div>
                        <a href="{{ route('user.my-courses') }}" class="w-full inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-semibold transition-colors">
                            Continue Learning
                        </a>
                    @else
                        <div class="w-full text-center bg-warning/10 text-warning rounded-lg py-2.5 text-sm font-semibold">
                            Purchase Pending Approval
                        </div>
                    @endif
                @else
                    <form action="{{ route('user.courses.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-semibold transition-colors">
                            {{ $course->isFree() ? 'Enroll for Free' : 'Get This Course' }}
                        </button>
                    </form>
                @endif

                <div class="mt-5 pt-5 border-t border-surface-border space-y-2 text-xs text-content-tertiary">
                    <div class="flex items-center justify-between">
                        <span>Level</span>
                        <span class="text-content-primary font-medium">{{ $course->level }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Lessons</span>
                        <span class="text-content-primary font-medium">{{ $course->lessons->count() }}</span>
                    </div>
                    @if ($course->instructor_name)
                        <div class="flex items-center justify-between">
                            <span>Instructor</span>
                            <span class="text-content-primary font-medium">{{ $course->instructor_name }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

        </div>


        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Ultrawavetrd.
            </p>
        </footer>
    </main>
