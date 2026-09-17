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
    <div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
</svg>
 Dashboard
    </a>
    <a href="{{ route('user.deposit') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
 Deposit
    </a>
        <a href="{{ route('user.investment.plan') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
</svg>
 Invest
    </a>
            <a href="{{ route('user.withdrawal') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
</svg>
 Withdraw
    </a>
            <a href="{{ route('user.trade') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
 Trade
    </a>
    <a href="{{ route('user.markets') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-primary text-content-inverse">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
</svg>
 Markets
    </a>
        <a href="{{ route('user.transactions') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
</svg>
 Transactions
    </a>
    <a href="{{ route('user.profile') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
 Settings
    </a>
</div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">Markets</h2>
        <p class="text-sm text-content-secondary mt-1">Live prices across crypto, forex, stocks, ETFs, and indices</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-primary-subtle shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Total Assets</p>
        <p class="text-lg font-bold text-content-primary">{{ $totalAssets }}</p>
    </div>
</div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-gain/10 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Top Gainer</p>
        <p class="text-lg font-bold text-content-primary">{{ $topGainer?->symbol ?? '—' }}</p>
        @if ($topGainer)
            <p class="text-xs font-medium text-gain">{{ $topGainer->price_change_pct_24h >= 0 ? '+' : '' }}{{ $topGainer->price_change_pct_24h }}%</p>
        @endif
    </div>
</div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-loss/10 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-loss" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75" />
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Top Loser</p>
        <p class="text-lg font-bold text-content-primary">{{ $topLoser?->symbol ?? '—' }}</p>
        @if ($topLoser)
            <p class="text-xs font-medium text-loss">{{ $topLoser->price_change_pct_24h }}%</p>
        @endif
    </div>
</div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-primary-subtle shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Active Markets</p>
        <p class="text-lg font-bold text-content-primary">{{ $activeMarkets }}</p>
    </div>
</div>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex flex-wrap items-center gap-2" role="tablist" aria-label="Filter by asset class">
            <a href="{{ route('user.markets') }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class ? 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' : 'bg-primary text-content-inverse' }}"
               role="tab"
               aria-selected="{{ $class ? 'false' : 'true' }}">
                All
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class ? 'bg-surface-base text-content-tertiary' : 'bg-white/20 text-white' }}">{{ $totalAssets }}</span>
            </a>
            @foreach (\App\Models\TradingAsset::ASSET_CLASSES as $key => $label)
                <a href="{{ route('user.markets', ['class' => $key]) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class === $key ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}"
                   role="tab"
                   aria-selected="{{ $class === $key ? 'true' : 'false' }}">
                    {{ $label }}
                    <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class === $key ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $classCounts[$key] ?? 0 }}</span>
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('user.markets') }}" class="relative flex-shrink-0">
            @if ($class)
                <input type="hidden" name="class" value="{{ $class }}">
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-tertiary absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
</svg>
            <input type="text"
                   name="search"
                   value="{{ $search }}"
                   placeholder="Search by name or symbol..."
                   class="w-full sm:w-64 pl-9 pr-4 py-2 text-sm bg-surface-overlay border border-surface-border rounded-lg text-content-primary placeholder-content-tertiary focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none"
                   aria-label="Search assets">
        </form>
    </div>

    <div class="hidden md:block bg-surface-raised border border-surface-border rounded-xl overflow-hidden mb-6">
        <table class="w-full text-sm" role="table">
            <caption class="sr-only">Available trading assets with prices and market data</caption>
            <thead>
                <tr class="border-b border-surface-border">
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">24h Change</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Class</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse ($assets as $asset)
                    <tr class="hover:bg-surface-overlay/50 transition-colors group">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if ($asset->logo_url)
                                    <img src="{{ $asset->logo_url }}" alt="" class="w-8 h-8 rounded-full bg-surface-overlay" loading="lazy">
                                @else
                                    <span class="w-8 h-8 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center">{{ strtoupper(mb_substr($asset->symbol, 0, 2)) }}</span>
                                @endif
                                <div>
                                    <span class="text-sm font-semibold text-content-primary">{{ $asset->name }}</span>
                                    <span class="text-xs text-content-tertiary ml-1">{{ $asset->symbol }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="text-sm font-medium text-content-primary">
                                ${{ $asset->formattedPrice() }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold {{ $asset->price_change_pct_24h >= 0 ? 'text-gain' : 'text-loss' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
                                    @if ($asset->price_change_pct_24h >= 0)
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                                    @else
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75" />
                                    @endif
</svg>
                                {{ $asset->price_change_pct_24h >= 0 ? '+' : '' }}{{ $asset->price_change_pct_24h }}%
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-surface-overlay text-content-secondary capitalize">
                                {{ $asset->asset_class }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('user.trade', ['asset' => $asset->id]) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg bg-primary hover:bg-primary-dark text-content-inverse transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100">
                                Trade
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
</svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-content-tertiary">No assets found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="md:hidden grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
        @forelse ($assets as $asset)
            <a href="{{ route('user.trade', ['asset' => $asset->id]) }}"
               class="bg-surface-raised border border-surface-border rounded-xl p-4 hover:bg-surface-overlay/50 transition-colors block">
                <div class="flex items-center gap-3 mb-3">
                    @if ($asset->logo_url)
                        <img src="{{ $asset->logo_url }}" alt="" class="w-10 h-10 rounded-full bg-surface-overlay" loading="lazy">
                    @else
                        <span class="w-10 h-10 rounded-full bg-primary/10 text-primary text-xs font-bold flex items-center justify-center">{{ strtoupper(mb_substr($asset->symbol, 0, 2)) }}</span>
                    @endif
                    <div class="min-w-0 flex-1">
                        <span class="text-sm font-semibold text-content-primary block truncate" title="{{ $asset->name }}">{{ $asset->name }}</span>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-content-tertiary">{{ $asset->symbol }}</span>
                            <span class="px-1.5 py-0.5 text-[10px] font-medium rounded bg-surface-overlay text-content-tertiary capitalize">{{ $asset->asset_class }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-lg font-bold text-content-primary">
                        ${{ $asset->formattedPrice() }}
                    </span>
                    <span class="inline-flex items-center gap-0.5 px-2 py-0.5 text-xs font-semibold rounded-full {{ $asset->price_change_pct_24h >= 0 ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3" aria-hidden="true">
                            @if ($asset->price_change_pct_24h >= 0)
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                            @else
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75" />
                            @endif
</svg>
                        {{ $asset->price_change_pct_24h >= 0 ? '+' : '' }}{{ $asset->price_change_pct_24h }}%
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-xl bg-surface-raised border border-surface-border p-8 text-center text-content-tertiary">
                No assets found.
            </div>
        @endforelse
    </div>

        </div>


        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Ultrawavetrd.
            </p>
        </footer>
    </main>

    <div x-data="{ open: false }"
         @open-mail-support.window="open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/60" @click="open = false"></div>
        <div x-show="open" x-transition class="relative w-full max-w-lg bg-surface-raised border border-surface-border rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-content-primary">Contact Support</h3>
                    <button @click="open = false" class="text-content-tertiary hover:text-content-primary"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
</button>
                </div>
                <form method="POST" action="{{ url('/') }}/sendcontact" class="space-y-4">
                    @csrf
                    <input type="hidden" name="to_email" value="Ultrawavetrd Support">
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Subject</label>
                        <input type="text" name="subject" required placeholder="How can we help?"
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Message</label>
                        <textarea name="message" rows="5" required placeholder="Describe your issue..."
                                  class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="open = false" class="flex-1 bg-surface-overlay text-content-secondary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">Cancel</button>
                        <button type="submit" name="contact" class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
