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
        <a href="{{ route('user.stocks.portfolio') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
 My Portfolio
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">Trade History</h2>
        <p class="text-sm text-content-secondary mt-1">Your stock buy and sell orders</p>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Stock</th>
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Side</th>
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Shares</th>
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Price / Share</th>
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Amount</th>
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Status</th>
                        <th class="text-left text-xs font-medium text-content-tertiary uppercase tracking-wider px-5 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-5 py-3.5 text-content-primary font-medium">{{ $order->stock->symbol ?? '—' }}</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $order->side === \App\Models\StockOrder::SIDE_BUY ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">
                                    {{ ucfirst($order->side) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-content-secondary">{{ rtrim(rtrim(number_format($order->quantity, 8), '0'), '.') ?: '0' }}</td>
                            <td class="px-5 py-3.5 text-content-secondary">${{ number_format($order->price_per_share, 2) }}</td>
                            <td class="px-5 py-3.5 text-content-secondary">${{ number_format($order->amount, 2) }}</td>
                            <td class="px-5 py-3.5">
                                @if ($order->status === \App\Models\StockOrder::STATUS_APPROVED)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gain/10 text-gain">Approved</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-warning/10 text-warning">Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-content-tertiary">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-content-tertiary">No stock trades yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

        </div>


        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Finvora Digital.
            </p>
        </footer>
    </main>
