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
        <a href="{{ route('user.nft-gallery') }}" class="inline-flex items-center gap-1 text-sm text-content-tertiary hover:text-content-primary transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            Back to Gallery
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
            <img src="{{ asset('storage/' . $nft->image_path) }}" alt="{{ $nft->name }}" class="w-full h-full object-cover">
        </div>

        <div>
            <div class="flex items-start justify-between gap-3 mb-2">
                <div>
                    @if ($nft->collection)
                        <p class="text-xs text-content-tertiary mb-1">{{ $nft->collection->name }}</p>
                    @endif
                    <h1 class="text-xl font-bold text-content-primary">{{ $nft->name }}</h1>
                </div>
                <form action="{{ route('user.nfts.like', $nft) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg bg-surface-overlay border border-surface-border {{ $nft->isLikedBy(Auth::user()) ? 'text-loss' : 'text-content-tertiary hover:text-loss' }} transition-colors" title="Like">
                        <svg class="w-5 h-5" fill="{{ $nft->isLikedBy(Auth::user()) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                    </button>
                </form>
            </div>

            <span class="inline-block mb-4 px-2.5 py-0.5 text-xs font-semibold rounded-full bg-primary/10 text-primary">{{ \App\Models\Nft::CATEGORIES[$nft->category] ?? $nft->category }}</span>

            <div class="rounded-xl bg-surface-raised border border-surface-border p-5 mb-4">
                <p class="text-xs text-content-tertiary mb-1">Price</p>
                <p class="text-2xl font-bold text-primary">{{ number_format($nft->price, 8) }} ETH</p>
            </div>

            @if ($nft->description)
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-content-primary mb-1.5">Description</h3>
                    <p class="text-sm text-content-secondary">{{ $nft->description }}</p>
                </div>
            @endif

            @if (! empty($nft->properties))
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-content-primary mb-2">Properties</h3>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($nft->properties as $trait => $value)
                            <div class="rounded-lg bg-surface-overlay border border-surface-border px-3 py-2">
                                <p class="text-[10px] text-content-tertiary uppercase tracking-wide">{{ $trait }}</p>
                                <p class="text-sm text-content-primary font-medium">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex items-center gap-6 text-xs text-content-tertiary">
                <span>Owner: {{ $nft->owner->name }}</span>
                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
                    {{ $nft->views_count }} views
                </span>
                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
</svg>
                    {{ $nft->likes->count() }} likes
                </span>
                <span>Minted {{ $nft->created_at->format('M d, Y') }}</span>
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
