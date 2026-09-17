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
        <a href="{{ route('user.copy-trading') }}" class="inline-flex items-center gap-1 text-sm text-content-tertiary hover:text-content-primary transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            Back to Copy Trading
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="relative flex-shrink-0">
                        <img src="{{ $trader->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($trader->name) }}" alt="{{ $trader->name }}" class="w-20 h-20 rounded-full object-cover ring-2 ring-surface-border">
                        @if ($trader->is_active)
                            <span class="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-gain rounded-full border-2 border-surface-raised" title="Active"></span>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-xl font-bold text-content-primary">{{ $trader->name }}</h1>
                            @if ($trader->is_verified)
                                <svg class="w-4 h-4 text-info" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><title>Verified</title><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 0 0 1.745-.723 3.066 3.066 0 0 1 3.976 0 3.066 3.066 0 0 0 1.745.723 3.066 3.066 0 0 1 2.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 0 1 0 3.976 3.066 3.066 0 0 0-.723 1.745 3.066 3.066 0 0 1-2.812 2.812 3.066 3.066 0 0 0-1.745.723 3.066 3.066 0 0 1-3.976 0 3.066 3.066 0 0 0-1.745-.723 3.066 3.066 0 0 1-2.812-2.812 3.066 3.066 0 0 0-.723-1.745 3.066 3.066 0 0 1 0-3.976 3.066 3.066 0 0 0 .723-1.745 3.066 3.066 0 0 1 2.812-2.812Zm7.44 5.252a.75.75 0 0 0-1.214-.882l-3.236 4.53L7.53 10.63a.75.75 0 0 0-1.06 1.061l2.25 2.25a.75.75 0 0 0 1.137-.089l3.75-5.25Z" clip-rule="evenodd" /></svg>
                            @endif
                        </div>
                        @if ($trader->headline)
                            <p class="text-sm text-content-secondary mt-1">{{ $trader->headline }}</p>
                        @endif
                        <div class="flex items-center gap-2 mt-2 flex-wrap">
                            <span class="bg-primary/10 text-primary text-xs font-medium px-2 py-0.5 rounded">{{ $trader->style_label }}</span>
                            <span class="bg-surface-overlay text-content-secondary text-xs font-medium px-2 py-0.5 rounded">{{ $trader->risk_level }} Risk</span>
                            <span class="text-content-tertiary text-xs">{{ number_format($trader->followers_count) }} followers</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-surface-border">
                    <div class="text-center">
                        <p class="text-lg font-bold text-gain">{{ number_format($trader->daily_roi_pct, 2) }}%</p>
                        <p class="text-[11px] text-content-tertiary mt-0.5">Daily ROI</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold text-gain">{{ number_format($trader->total_roi_pct, 1) }}%</p>
                        <p class="text-[11px] text-content-tertiary mt-0.5">Total ROI ({{ $trader->duration_days }}d)</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold text-content-primary">{{ number_format($trader->win_rate_pct, 0) }}%</p>
                        <p class="text-[11px] text-content-tertiary mt-0.5">Win Rate</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold text-content-primary">{{ number_format($trader->total_trades) }}</p>
                        <p class="text-[11px] text-content-tertiary mt-0.5">Total Trades</p>
                    </div>
                </div>
            </div>

            @if ($trader->bio)
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <h3 class="text-sm font-semibold text-content-primary mb-2">About {{ $trader->name }}</h3>
                    <p class="text-sm text-content-secondary leading-relaxed">{{ $trader->bio }}</p>
                </div>
            @endif

            @if (! empty($trader->markets_traded))
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <h3 class="text-sm font-semibold text-content-primary mb-3">Markets Traded</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($trader->markets_traded as $market)
                            <span class="px-2.5 py-1 rounded-lg bg-surface-overlay border border-surface-border text-xs text-content-secondary">{{ $market }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-sm font-semibold text-content-primary mb-3">Trader Profile</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="flex justify-between border-b border-surface-border pb-2">
                        <dt class="text-content-tertiary">Years Experience</dt>
                        <dd class="text-content-primary font-medium">{{ $trader->years_experience }} yrs</dd>
                    </div>
                    <div class="flex justify-between border-b border-surface-border pb-2">
                        <dt class="text-content-tertiary">Minimum Capital</dt>
                        <dd class="text-content-primary font-medium">${{ number_format($trader->min_capital, 2) }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-surface-border pb-2">
                        <dt class="text-content-tertiary">Copy Period</dt>
                        <dd class="text-content-primary font-medium">{{ $trader->duration_days }} days</dd>
                    </div>
                    <div class="flex justify-between border-b border-surface-border pb-2">
                        <dt class="text-content-tertiary">Risk Level</dt>
                        <dd class="text-content-primary font-medium">{{ $trader->risk_level }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6 lg:sticky lg:top-20">
                <h3 class="text-sm font-semibold text-content-primary mb-1">Copy {{ $trader->name }}</h3>
                <p class="text-xs text-content-tertiary mb-4">Automatically mirror this trader's positions with your own capital.</p>

                <form action="{{ route('user.copy-trading.subscribe') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="trader_id" value="{{ $trader->id }}">
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Amount to Invest (USD)</label>
                        <input type="number" step="0.01" name="amount" min="{{ $trader->min_capital }}" value="{{ $trader->min_capital }}" required
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary">
                        <p class="text-[11px] text-content-tertiary mt-1">Minimum ${{ number_format($trader->min_capital, 2) }}</p>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-semibold transition-colors">
                        Copy This Trader
                    </button>
                </form>

                <div class="mt-5 pt-5 border-t border-surface-border space-y-2 text-xs text-content-tertiary">
                    <div class="flex items-center justify-between">
                        <span>Daily ROI</span>
                        <span class="text-gain font-medium">{{ number_format($trader->daily_roi_pct, 2) }}%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Win Rate</span>
                        <span class="text-content-primary font-medium">{{ number_format($trader->win_rate_pct, 0) }}%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Followers</span>
                        <span class="text-content-primary font-medium">{{ number_format($trader->followers_count) }}</span>
                    </div>
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
