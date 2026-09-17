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

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('user.stocks') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
</svg>
 Stocks
        </a>
        <a href="{{ route('user.stocks.history') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
 Trade History
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">My Portfolio</h2>
        <p class="text-sm text-content-secondary mt-1">Your current stock positions</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 min-w-0 overflow-hidden col-span-2">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Portfolio Value</p>
            <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">${{ number_format($totalValue, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 min-w-0 overflow-hidden col-span-2">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Unrealized Gain/Loss</p>
            <p class="text-[15px] sm:text-2xl font-bold {{ $totalGain >= 0 ? 'text-gain' : 'text-loss' }} truncate">
                {{ $totalGain >= 0 ? '+' : '-' }}${{ number_format(abs($totalGain), 2) }}
            </p>
        </div>
    </div>

    @if ($positions->isEmpty())
        <div class="bg-surface-raised border border-surface-border rounded-xl p-10 text-center text-content-tertiary">
            You don't hold any stocks yet.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($positions as $position)
                <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            @if ($position->stock->logo_url)
                                <img src="{{ $position->stock->logo_url }}" alt="{{ $position->stock->symbol }}" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                            @else
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0">{{ strtoupper(mb_substr($position->stock->symbol, 0, 2)) }}</div>
                            @endif
                            <div>
                                <a href="{{ route('user.stocks.show', $position->stock) }}" class="text-sm font-semibold text-content-primary hover:text-primary transition-colors">{{ $position->stock->symbol }}</a>
                                <p class="text-xs text-content-tertiary truncate max-w-[160px]">{{ $position->stock->name }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium {{ $position->gain >= 0 ? 'text-gain' : 'text-loss' }}">
                            {{ $position->gain >= 0 ? '+' : '' }}{{ $position->gain_percent }}%
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div>
                            <span class="text-content-tertiary block">Shares Held</span>
                            <span class="text-content-primary font-medium">{{ rtrim(rtrim(number_format($position->shares, 8), '0'), '.') ?: '0' }}</span>
                        </div>
                        <div>
                            <span class="text-content-tertiary block">Avg. Cost</span>
                            <span class="text-content-primary font-medium">${{ number_format($position->avg_cost, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-content-tertiary block">Cost Basis</span>
                            <span class="text-content-primary font-medium">${{ number_format($position->cost_basis, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-content-tertiary block">Current Value</span>
                            <span class="text-content-primary font-medium">${{ number_format($position->current_value, 2) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 mt-3 border-t border-surface-border">
                        <span class="text-xs text-content-tertiary">Unrealized Gain/Loss</span>
                        <span class="text-sm font-semibold {{ $position->gain >= 0 ? 'text-gain' : 'text-loss' }}">
                            {{ $position->gain >= 0 ? '+' : '-' }}${{ number_format(abs($position->gain), 2) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

        </div>


        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Finvora Digital.
            </p>
        </footer>
    </main>
