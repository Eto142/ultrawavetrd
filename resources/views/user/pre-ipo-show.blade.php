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
                @if ($errors->any())
                    toasts.push({ id: Date.now() + 2, message: @js($errors->first()), type: 'error' });
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
        <a href="{{ route('user.pre-ipo') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
</svg>
 Pre-IPO
        </a>
        <a href="{{ route('user.pre-ipo.holdings') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
</svg>
 My Holdings
        </a>
    </div>

    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0">{{ strtoupper(mb_substr($company->symbol, 0, 2)) }}</div>
            <div>
                <h2 class="text-xl font-bold text-content-primary">{{ $company->name }}</h2>
                <p class="text-sm text-content-secondary">{{ $company->symbol }} @if($company->sector) — {{ $company->sector }} @endif</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-5">

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors min-w-0 overflow-hidden">
                    <div class="flex items-start justify-between mb-3">
                        <div class="p-2.5 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
</svg>
                        </div>
                    </div>
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Share Price</p>
                    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">${{ number_format($company->share_price, 2) }}</p>
                </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors min-w-0 overflow-hidden">
                    <div class="flex items-start justify-between mb-3">
                        <div class="p-2.5 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
                        </div>
                    </div>
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Initial Price</p>
                    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">${{ number_format($company->initial_price, 2) }}</p>
                </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors min-w-0 overflow-hidden">
                    <div class="flex items-start justify-between mb-3">
                        <div class="p-2.5 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
                        </div>
                    </div>
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Change</p>
                    <p class="text-[15px] sm:text-2xl font-bold {{ $company->price_change_percent >= 0 ? 'text-gain' : 'text-loss' }} truncate">{{ $company->price_change_percent >= 0 ? '+' : '' }}{{ $company->price_change_percent }}%</p>
                </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors min-w-0 overflow-hidden">
                    <div class="flex items-start justify-between mb-3">
                        <div class="p-2.5 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
</svg>
                        </div>
                    </div>
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Available</p>
                    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">{{ number_format($company->shares_available) }}</p>
                </div>
            </div>

            @if ($company->description)
                <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-content-primary mb-2">About {{ $company->name }}</h3>
                    <p class="text-sm text-content-secondary leading-relaxed">{{ $company->description }}</p>
                </div>
            @endif

            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <h3 class="text-sm font-semibold text-content-primary mb-3">Details</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-content-tertiary text-xs">Sector</p>
                        <p class="text-content-primary">{{ $company->sector ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-content-tertiary text-xs">Total Shares</p>
                        <p class="text-content-primary">{{ number_format($company->total_shares) }}</p>
                    </div>
                    <div>
                        <p class="text-content-tertiary text-xs">Shares Sold</p>
                        <p class="text-content-primary">{{ number_format($company->shares_sold) }}</p>
                    </div>
                    <div>
                        <p class="text-content-tertiary text-xs">Min Purchase</p>
                        <p class="text-content-primary">{{ $company->min_purchase }} share{{ $company->min_purchase === 1 ? '' : 's' }}</p>
                    </div>
                    @if ($company->max_purchase_per_user)
                        <div>
                            <p class="text-content-tertiary text-xs">Max Per User</p>
                            <p class="text-content-primary">{{ $company->max_purchase_per_user }}</p>
                        </div>
                    @endif
                    @if ($company->expected_ipo_date)
                        <div>
                            <p class="text-content-tertiary text-xs">Expected IPO</p>
                            <p class="text-content-primary">{{ $company->expected_ipo_date->format('M d, Y') }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-content-tertiary text-xs">Status</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $company->status === 'open' ? 'bg-gain/10 text-gain' : ($company->status === 'upcoming' ? 'bg-info/10 text-info' : 'bg-surface-overlay text-content-tertiary') }}">
                            {{ ucfirst($company->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5"
                 x-data="{ qty: {{ $company->min_purchase }}, price: {{ $company->share_price }}, min: {{ $company->min_purchase }}, max: {{ $company->max_purchase_per_user ? min($company->max_purchase_per_user, $company->shares_available) : $company->shares_available }} }">
                <h3 class="text-sm font-semibold text-content-primary mb-3">Buy Shares</h3>

                @if ($company->status !== 'open')
                    <p class="text-sm text-content-tertiary">This offering is not currently open for purchase.</p>
                @elseif ($company->shares_available < $company->min_purchase)
                    <p class="text-sm text-content-tertiary">This offering is sold out.</p>
                @else
                    <form action="{{ route('user.pre-ipo.buy', $company) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-xs text-content-tertiary block mb-1">Quantity</label>
                            <input type="number" name="quantity" x-model.number="qty" :min="min" :max="max" required
                                   class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-surface-border">
                            <span class="text-xs text-content-tertiary">Price per Share</span>
                            <span class="text-sm font-medium text-content-primary">${{ number_format($company->share_price, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-2">
                            <span class="text-xs text-content-tertiary">Total Cost</span>
                            <span class="text-sm font-bold text-primary" x-text="'$' + (qty * price).toFixed(2)"></span>
                        </div>
                        <button type="submit"
                                class="w-full bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Buy Shares
                        </button>
                    </form>
                @endif
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
