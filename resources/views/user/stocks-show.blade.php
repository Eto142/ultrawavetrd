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

    <div class="w-full overflow-hidden rounded-lg border border-surface-border bg-surface-raised mb-6">
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
            "symbols": [
                {"proName": "FOREXCOM:SPXUSD", "title": "S&P 500 Index"},
                {"proName": "FOREXCOM:NSXUSD", "title": "US 100 Cash CFD"},
                {"proName": "FX_IDC:EURUSD", "title": "EUR to USD"},
                {"proName": "BITSTAMP:BTCUSD", "title": "Bitcoin"},
                {"proName": "BITSTAMP:ETHUSD", "title": "Ethereum"},
                {"proName": "FOREXCOM:UKXGBP", "title": "UK 100"}
            ],
            "showSymbolLogo": true,
            "isTransparent": true,
            "displayMode": "regular",
            "colorTheme": "dark",
            "locale": "en"
        }
        </script>
    </div>
    <!-- TradingView Widget END -->
</div>

    <div class="mb-4">
        <a href="{{ route('user.stocks') }}" class="inline-flex items-center gap-1 text-sm text-content-tertiary hover:text-content-primary transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            Back to Stocks
        </a>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl p-6 mb-6">
        <div class="flex items-center gap-4 mb-4">
            @if ($stock->logo_url)
                <img src="{{ $stock->logo_url }}" alt="{{ $stock->symbol }}" class="w-14 h-14 rounded-full object-cover bg-surface-overlay">
            @else
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">
                    {{ strtoupper(mb_substr($stock->symbol, 0, 2)) }}
                </div>
            @endif
            <div>
                <h1 class="text-xl font-bold text-content-primary">{{ $stock->name }}</h1>
                <p class="text-sm text-content-tertiary">{{ $stock->symbol }}</p>
            </div>
        </div>
        <div class="flex items-end gap-3">
            <span class="text-3xl font-bold text-content-primary">${{ number_format($stock->price, 2) }}</span>
            <span class="text-sm font-medium px-2 py-0.5 rounded {{ $stock->change_percent >= 0 ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">
                {{ $stock->change_percent >= 0 ? '+' : '' }}{{ $stock->change_percent }}%
                ({{ $stock->change_amount >= 0 ? '+' : '' }}${{ number_format(abs($stock->change_amount), 2) }})
            </span>
        </div>
        <div class="flex items-center gap-6 mt-3 text-xs text-content-tertiary">
            <span>High: ${{ number_format($stock->day_high, 2) }}</span>
            <span>Low: ${{ number_format($stock->day_low, 2) }}</span>
            <span>Vol: {{ number_format($stock->volume) }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2">
            <div x-data="{ tab: 'buy', buyAmount: '', sellShares: '', price: {{ $stock->price }}, held: {{ $heldQuantity }} }" class="bg-surface-raised border border-surface-border rounded-xl p-6">

                <div class="flex gap-1 mb-6 bg-surface-overlay rounded-lg p-1">
                    <button @click="tab = 'buy'" :class="tab === 'buy' ? 'bg-gain text-white' : 'text-content-secondary hover:text-content-primary'"
                            class="flex-1 py-2 text-sm font-medium rounded-md transition-colors">Buy</button>
                    <button @click="tab = 'sell'" :class="tab === 'sell' ? 'bg-loss text-white' : 'text-content-secondary hover:text-content-primary'"
                            class="flex-1 py-2 text-sm font-medium rounded-md transition-colors">Sell</button>
                </div>

                <div x-show="tab === 'buy'" x-cloak>
                    <form action="{{ route('user.stocks.buy', $stock) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Amount (USD)</label>
                            <input type="number" name="amount" x-model="buyAmount" step="0.01" min="1" required
                                   class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="Enter dollar amount..." />
                        </div>

                        <div class="bg-surface-overlay rounded-lg p-4 mb-4">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-content-tertiary">You will receive</span>
                                <span class="text-content-primary font-medium" x-text="buyAmount > 0 ? (buyAmount / price).toFixed(6) + ' shares' : '—'"></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-content-tertiary">Price per share</span>
                                <span class="text-content-primary">${{ number_format($stock->price, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gain hover:bg-gain/90 text-white rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Buy {{ $stock->symbol }}
                        </button>
                    </form>
                </div>

                <div x-show="tab === 'sell'" x-cloak>
                    <template x-if="held <= 0">
                        <div class="text-center py-8">
                            <p class="text-content-tertiary text-sm">You don't hold any shares of {{ $stock->symbol }}.</p>
                            <p class="text-content-tertiary text-xs mt-1">Buy some shares first to start selling.</p>
                        </div>
                    </template>
                    <template x-if="held > 0">
                        <form action="{{ route('user.stocks.sell', $stock) }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-content-secondary mb-1.5">Shares</label>
                                <input type="number" name="quantity" x-model="sellShares" step="0.00000001" min="0.00000001" :max="held" required
                                       class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Enter number of shares..." />
                                <p class="text-xs text-content-tertiary mt-1.5">You hold <span x-text="held"></span> shares.</p>
                            </div>

                            <div class="bg-surface-overlay rounded-lg p-4 mb-4">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-content-tertiary">You will receive</span>
                                    <span class="text-content-primary font-medium" x-text="sellShares > 0 ? '$' + (sellShares * price).toFixed(2) : '—'"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-content-tertiary">Price per share</span>
                                    <span class="text-content-primary">${{ number_format($stock->price, 2) }}</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-loss hover:bg-loss/90 text-white rounded-lg py-2.5 text-sm font-medium transition-colors">
                                Sell {{ $stock->symbol }}
                            </button>
                        </form>
                    </template>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <h4 class="text-xs font-semibold text-content-tertiary uppercase tracking-wider mb-3">Your Position</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-content-tertiary">Shares Held</span>
                        <span class="text-content-primary font-medium">{{ rtrim(rtrim(number_format($heldQuantity, 8), '0'), '.') ?: '0' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-content-tertiary">Current Value</span>
                        <span class="text-content-primary font-medium">${{ number_format($heldQuantity * (float) $stock->price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>


        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Finvora Digital.
            </p>
        </footer>
    </main>
