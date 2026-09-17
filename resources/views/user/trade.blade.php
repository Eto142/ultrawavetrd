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

    <style>
        @keyframes  preloader-progress {
            from { width: 0% }
            to   { width: 100% }
        }
    </style>
    <div x-data="{ loading: true }"
         x-show="loading"
         x-init="setTimeout(() => loading = false, 2000)"
         @chart-ready.window="loading = false"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] bg-surface-base flex items-center justify-center">
        <div class="flex flex-col items-center gap-5">

            <div class="relative">
                <div class="w-12 h-12 rounded-full border-[3px] border-surface-border border-t-primary animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                </div>
            </div>

            <div class="text-center">
                <p class="text-content-primary text-sm font-semibold tracking-wide">Loading Trading Platform</p>
                <p class="text-content-tertiary text-xs mt-1.5">Preparing your trading environment&hellip;</p>
            </div>

            <div class="w-48 h-[3px] rounded-full bg-surface-overlay overflow-hidden">
                <div class="h-full bg-primary rounded-full" style="animation: preloader-progress 2.5s ease-in-out forwards"></div>
            </div>
        </div>
    </div>

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
        bg-primary text-content-inverse">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
 Trade
    </a>
    <a href="{{ route('user.markets') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
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

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Trading</h2>
            <p class="text-sm text-content-secondary mt-1">Execute binary & spot trades on live markets</p>
        </div>
        <a href="{{ route('user.trading-history') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
            Trade History
        </a>
    </div>

    <div x-data="tradePanel()" x-init="init()" class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <div class="lg:col-span-4 space-y-4">

            <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
                <div class="px-5 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button @click="isDemo = false" :class="!isDemo ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                            Live
                        </button>
                        <button @click="isDemo = true" :class="isDemo ? 'bg-warning text-surface-base' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                            Demo
                        </button>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-content-tertiary" x-text="isDemo ? 'Demo Balance' : 'Live Balance'"></span>
                        <div class="text-sm font-bold" :class="isDemo ? 'text-warning' : 'text-gain'">
                            <span x-show="!isDemo">$0.00</span>
                            <span x-show="isDemo" x-cloak>$10,000.00</span>
                        </div>
                    </div>
                </div>
                <template x-if="isDemo">
                    <div class="px-5 py-2 bg-warning/10 border-t border-warning/20 text-xs text-warning font-medium text-center">
                        Demo Mode — Virtual funds, no real money at risk
                    </div>
                </template>
            </div>

            <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
                <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full animate-pulse" :class="isDemo ? 'bg-warning' : 'bg-gain'"></div>
                        <span class="text-sm font-semibold" :class="isDemo ? 'text-warning' : 'text-gain'" x-text="isDemo ? 'Demo Trading' : 'Live Trading'"></span>
                    </div>

                    <div class="flex gap-1">
                        <button @click="tradeType = 'binary'" :class="tradeType === 'binary' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors">
                            Binary
                        </button>
                        <button @click="tradeType = 'spot'" :class="tradeType === 'spot' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors">
                            Spot
                        </button>
                    </div>
                </div>

                <form id="tradeForm" action="{{ route('user.trade.store') }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    <input type="hidden" name="trade_type" :value="tradeType">
                    <input type="hidden" name="is_demo" :value="isDemo ? 1 : 0">
                    <input type="hidden" name="action" x-ref="tradeAction">

                    <div>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Asset Class</label>
                        <div class="flex flex-wrap gap-1">
                            <template x-for="cls in assetClasses" :key="cls.key">
                                <button type="button" @click="filterClass = cls.key; filterAssets()"
                                        :class="filterClass === cls.key ? 'bg-primary text-content-inverse border-primary' : 'bg-surface-overlay text-content-secondary border-surface-border hover:text-content-primary'"
                                        class="px-2.5 py-1 text-xs font-medium rounded-lg border transition-colors"
                                        x-text="cls.label">
                                </button>
                            </template>
                        </div>
                    </div>

                    <div x-data="{ pickerOpen: false }" @click.outside="pickerOpen = false" class="relative">
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Select Asset</label>
                        <input type="hidden" name="trading_asset_id" :value="selectedAssetId">
                        <button type="button" @click="pickerOpen = !pickerOpen"
                                class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-primary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors text-left">
                            <template x-if="selectedAsset && selectedAsset.logo_url">
                                <img :src="selectedAsset.logo_url" class="w-5 h-5 rounded-full flex-shrink-0" :alt="selectedAsset.symbol">
                            </template>
                            <template x-if="selectedAsset && !selectedAsset.logo_url">
                                <span class="w-5 h-5 rounded-full bg-primary/20 text-primary text-[10px] font-bold flex items-center justify-center flex-shrink-0" x-text="selectedAsset.symbol.substring(0,2)"></span>
                            </template>
                            <template x-if="!selectedAsset">
                                <span class="w-5 h-5 rounded-full bg-surface-border flex-shrink-0"></span>
                            </template>
                            <span class="flex-1 truncate" x-text="selectedAsset ? selectedAsset.symbol + ' — ' + selectedAsset.name : '— Choose an asset —'"
                                  :class="selectedAsset ? 'text-content-primary' : 'text-content-tertiary'"></span>
                            <svg class="w-4 h-4 text-content-tertiary flex-shrink-0 transition-transform" :class="pickerOpen && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div x-show="pickerOpen" x-cloak x-transition.opacity
                             class="absolute z-50 mt-1 w-full max-h-56 overflow-y-auto rounded-lg bg-surface-overlay border border-surface-border shadow-xl">
                            <template x-for="asset in filteredAssets" :key="asset.id">
                                <button type="button" @click="selectedAssetId = asset.id; onAssetChange(); pickerOpen = false"
                                        class="w-full flex items-center gap-2.5 px-3 py-2 hover:bg-surface-border/40 transition-colors"
                                        :class="selectedAssetId == asset.id && 'bg-primary/10'">
                                    <template x-if="asset.logo_url">
                                        <img :src="asset.logo_url" class="w-5 h-5 rounded-full flex-shrink-0" :alt="asset.symbol">
                                    </template>
                                    <template x-if="!asset.logo_url">
                                        <span class="w-5 h-5 rounded-full bg-primary/20 text-primary text-[10px] font-bold flex items-center justify-center flex-shrink-0" x-text="asset.symbol.substring(0,2)"></span>
                                    </template>
                                    <span class="text-sm text-content-primary font-medium" x-text="asset.symbol"></span>
                                    <span class="text-xs text-content-tertiary truncate" x-text="asset.name"></span>
                                    <span class="ml-auto text-xs font-medium" :class="(asset.price_change_pct_24h ?? 0) >= 0 ? 'text-gain' : 'text-loss'"
                                          x-text="'$' + formatPrice(asset.price)"></span>
                                </button>
                            </template>
                            <div x-show="filteredAssets.length === 0" class="px-3 py-4 text-xs text-content-tertiary text-center">No assets in this class</div>
                        </div>
                    </div>

                    <div x-show="selectedAsset" x-cloak class="flex items-center justify-between px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border">
                        <div class="flex items-center gap-2">
                            <template x-if="selectedAsset && selectedAsset.logo_url">
                                <img :src="selectedAsset.logo_url" class="w-5 h-5 rounded-full" :alt="selectedAsset.symbol">
                            </template>
                            <span class="text-xs text-content-secondary">Entry Price</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-content-primary" x-text="'$' + formatPrice(selectedAsset?.price)"></span>
                            <span class="text-xs ml-1" :class="(selectedAsset?.price_change_pct_24h ?? 0) >= 0 ? 'text-gain' : 'text-loss'"
                                  x-text="((selectedAsset?.price_change_pct_24h ?? 0) >= 0 ? '+' : '') + Number(selectedAsset?.price_change_pct_24h ?? 0).toFixed(2) + '%'">
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Leverage</label>
                        <input type="hidden" name="leverage" :value="leverage">
                        <div class="grid grid-cols-6 gap-1.5">
                            <template x-for="lev in leverageOptions" :key="lev">
                                <button type="button" @click="leverage = lev"
                                        :class="leverage === lev ? 'bg-primary text-content-inverse border-primary' : 'bg-surface-overlay text-content-secondary border-surface-border hover:bg-primary/10 hover:text-primary'"
                                        class="py-2 text-xs font-semibold rounded-lg border transition-colors text-center"
                                        x-text="lev + 'x'">
                                </button>
                            </template>
                        </div>
                    </div>

                    <div x-show="tradeType === 'binary'" x-cloak>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Duration</label>
                        <input type="hidden" name="duration" :value="duration">
                        <div class="grid grid-cols-7 gap-1.5">
                            <template x-for="d in durationOptions" :key="d.value">
                                <button type="button" @click="duration = d.value"
                                        :class="duration === d.value ? 'bg-primary text-content-inverse border-primary' : 'bg-surface-overlay text-content-secondary border-surface-border hover:bg-primary/10 hover:text-primary'"
                                        class="py-2 text-xs font-semibold rounded-lg border transition-colors text-center"
                                        x-text="d.label">
                                </button>
                            </template>
                        </div>
                    </div>
                    <template x-if="tradeType === 'spot'">
                        <p class="text-xs text-content-tertiary italic">Spot trades have no expiry — request close anytime, settled by admin.</p>
                    </template>

                    <div>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Amount (USD)</label>
                        <input type="number" name="amount" x-model.number="amount" step="0.01" min="1" required placeholder="Enter trade amount"
                               class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    <div x-show="amount > 0 && leverage > 0" x-cloak class="rounded-lg bg-surface-overlay border border-surface-border p-3">
                        <div class="text-xs text-content-tertiary mb-2">Potential Outcome Preview</div>
                        <div class="grid grid-cols-2 gap-3 text-center">
                            <div>
                                <div class="text-xs text-content-secondary mb-0.5">If WIN</div>
                                <span class="text-sm font-bold text-gain" x-text="'+$' + (amount * leverage / 100).toFixed(2)"></span>
                            </div>
                            <div>
                                <div class="text-xs text-content-secondary mb-0.5">If LOSS</div>
                                <span class="text-sm font-bold text-loss" x-text="'-$' + (amount * leverage / 100).toFixed(2)"></span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <button type="button" @click="confirmTrade('buy')"
                                class="py-3 rounded-lg bg-gain hover:bg-gain/80 text-white text-sm font-bold transition-colors flex items-center justify-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
</svg>
                            Buy / Long
                        </button>
                        <button type="button" @click="confirmTrade('sell')"
                                class="py-3 rounded-lg bg-loss hover:bg-loss/80 text-white text-sm font-bold transition-colors flex items-center justify-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75" />
</svg>
                            Sell / Short
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-8 rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
                <h3 class="text-sm font-semibold text-content-primary">Live Chart</h3>
                <span class="text-xs text-content-tertiary ml-auto" x-text="selectedAsset ? selectedAsset.symbol : ''"></span>
            </div>
            <div id="tv_chart_wrapper" style="height:685px;">
                <div class="tradingview-widget-container" style="height:100%;width:100%">
                    <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "autosize": true,
                        "symbol": "NASDAQ:AAPL",
                        "interval": "1",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "en",
                        "backgroundColor": "rgba(22, 26, 30, 1)",
                        "gridColor": "rgba(42, 47, 54, 0.3)",
                        "allow_symbol_change": true,
                        "hide_side_toolbar": false,
                        "calendar": false,
                        "studies": ["MACD@tv-basicstudies"],
                        "support_host": "https://www.tradingview.com"
                    }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 rounded-xl bg-surface-raised border border-surface-border overflow-hidden" x-data="{ tradeTab: 'open' }">
        <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
            <h3 class="text-sm font-semibold text-content-primary">Active Trades</h3>
            <div class="flex gap-1">
                <button @click="tradeTab = 'open'"
                        :class="tradeTab === 'open' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary'"
                        class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors">
                    Open ({{ $openTrades->count() }})
                </button>
                <button @click="tradeTab = 'closed'"
                        :class="tradeTab === 'closed' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary'"
                        class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors">
                    Closed ({{ $closedTrades->count() }})
                </button>
            </div>
        </div>

        <div x-show="tradeTab === 'open'" class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Action</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Leverage</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Entry</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Expires</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse ($openTrades as $trade)
                        <tr>
                            <td class="px-4 py-3 text-content-tertiary">#{{ $trade->id }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-surface-overlay text-content-secondary capitalize">{{ $trade->trade_type }}</span>
                            </td>
                            <td class="px-4 py-3 text-content-primary font-medium">{{ $trade->tradingAsset->symbol }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-semibold {{ $trade->side === 'buy' ? 'text-gain' : 'text-loss' }}">{{ $trade->side === 'buy' ? 'Buy / Long' : 'Sell / Short' }}</span>
                            </td>
                            <td class="px-4 py-3 text-content-secondary">${{ number_format($trade->amount, 2) }}</td>
                            <td class="px-4 py-3 text-content-secondary">{{ $trade->leverage }}x</td>
                            <td class="px-4 py-3 text-content-secondary">${{ \App\Models\TradingAsset::formatPrice($trade->entry_price) }}</td>
                            <td class="px-4 py-3 text-content-tertiary">
                                @if ($trade->trade_type === 'binary')
                                    @if ($trade->isExpired())
                                        <span class="text-warning">Expired</span>
                                    @else
                                        {{ $trade->expires_at->format('M d, H:i') }}
                                    @endif
                                @else
                                    No expiry
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($trade->trade_type === 'spot')
                                    @if ($trade->isPendingClose())
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-warning/10 text-warning">Pending Closure</span>
                                    @else
                                        <form action="{{ route('user.trade.close', $trade) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-xs font-medium transition-colors">Close</button>
                                        </form>
                                    @endif
                                @else
                                    @if ($trade->isExpired())
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-warning/10 text-warning">Awaiting Settlement</span>
                                    @else
                                        <span class="text-content-tertiary">—</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="px-4 py-8 text-center text-content-tertiary">No open trades found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-3"></div>
        </div>

        <div x-show="tradeTab === 'closed'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Action</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Leverage</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Entry</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Exit</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Result</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">P/L</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Settled</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse ($closedTrades as $trade)
                        <tr>
                            <td class="px-4 py-3 text-content-tertiary">#{{ $trade->id }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-surface-overlay text-content-secondary capitalize">{{ $trade->trade_type }}</span>
                            </td>
                            <td class="px-4 py-3 text-content-primary font-medium">{{ $trade->tradingAsset->symbol }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-semibold {{ $trade->side === 'buy' ? 'text-gain' : 'text-loss' }}">{{ $trade->side === 'buy' ? 'Buy / Long' : 'Sell / Short' }}</span>
                            </td>
                            <td class="px-4 py-3 text-content-secondary">${{ number_format($trade->amount, 2) }}</td>
                            <td class="px-4 py-3 text-content-secondary">{{ $trade->leverage }}x</td>
                            <td class="px-4 py-3 text-content-secondary">${{ \App\Models\TradingAsset::formatPrice($trade->entry_price) }}</td>
                            <td class="px-4 py-3 text-content-secondary">{{ $trade->exit_price ? '$' . \App\Models\TradingAsset::formatPrice($trade->exit_price) : '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $trade->status === 'won' ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ ucfirst($trade->status) }}</span>
                            </td>
                            <td class="px-4 py-3 {{ ($trade->pnl ?? 0) >= 0 ? 'text-gain' : 'text-loss' }} font-medium">{{ $trade->pnl !== null ? (($trade->pnl >= 0 ? '+' : '') . '$' . number_format($trade->pnl, 2)) : '—' }}</td>
                            <td class="px-4 py-3 text-content-tertiary">{{ $trade->closed_at?->format('M d, Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="px-4 py-8 text-center text-content-tertiary">No closed trades found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-3"></div>
        </div>
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

<script type="text/javascript">
    function initChart(symbol) {
        symbol = symbol || 'NASDAQ:AAPL';
        const wrapper = document.getElementById('tv_chart_wrapper');
        if (!wrapper) return;

        wrapper.innerHTML = '';

        var container = document.createElement('div');
        container.className = 'tradingview-widget-container';
        container.style.cssText = 'height:100%;width:100%';

        var widgetDiv = document.createElement('div');
        widgetDiv.className = 'tradingview-widget-container__widget';
        widgetDiv.style.cssText = 'height:100%;width:100%';
        container.appendChild(widgetDiv);

        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js';
        script.async = true;
        script.textContent = JSON.stringify({
            autosize: true,
            symbol: symbol,
            interval: '1',
            timezone: 'Etc/UTC',
            theme: 'dark',
            style: '1',
            locale: 'en',
            backgroundColor: 'rgba(22, 26, 30, 1)',
            gridColor: 'rgba(42, 47, 54, 0.3)',
            allow_symbol_change: true,
            hide_side_toolbar: false,
            calendar: false,
            studies: ['MACD@tv-basicstudies'],
            support_host: 'https://www.tradingview.com'
        });
        container.appendChild(script);
        wrapper.appendChild(container);

        window.dispatchEvent(new Event('chart-ready'));
    }

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            window.dispatchEvent(new Event('chart-ready'));
        }, 1500);
    });
</script>

<script>
    function tradePanel() {
        return {
            isDemo: false,
            tradeType: 'binary',
            filterClass: 'crypto',
            selectedAssetId: '',
            selectedAsset: null,
            leverage: 5,
            duration: 5,
            amount: 0,

            leverageOptions: [2, 5, 10, 25, 50, 100],
            durationOptions: [
                { value: 1, label: '1m' },
                { value: 5, label: '5m' },
                { value: 15, label: '15m' },
                { value: 30, label: '30m' },
                { value: 60, label: '1h' },
                { value: 240, label: '4h' },
                { value: 1440, label: '1d' },
            ],
            assetClasses: [
                { key: 'crypto', label: 'Crypto' },
                { key: 'forex', label: 'Forex' },
                { key: 'stock', label: 'Stocks' },
                { key: 'etf', label: 'ETFs' },
                { key: 'index', label: 'Indices' },
            ],

            allAssets: @json($assets),
            filteredAssets: [],

            init() {
                @if ($preselectedAssetId)
                    const preselected = this.allAssets.find(a => a.id === {{ $preselectedAssetId }});
                    if (preselected) {
                        this.filterClass = preselected.asset_class;
                        this.selectedAssetId = preselected.id;
                    }
                @endif
                this.filterAssets();
                @if ($preselectedAssetId)
                    if (preselected) {
                        this.onAssetChange();
                    }
                @endif
            },

            filterAssets() {
                this.filteredAssets = this.allAssets.filter(a => a.asset_class === this.filterClass);
                if (this.selectedAssetId && !this.filteredAssets.find(a => a.id == this.selectedAssetId)) {
                    this.selectedAssetId = '';
                    this.selectedAsset = null;
                }
            },

            onAssetChange() {
                const id = parseInt(this.selectedAssetId);
                this.selectedAsset = this.allAssets.find(a => a.id === id) || null;
                if (this.selectedAsset) {
                    this.updateChart(this.selectedAsset);
                }
            },

            updateChart(asset) {
                let cleanSymbol = asset.symbol
                    .toUpperCase()
                    .replace(/\//g, '')
                    .replace(/-/g, '')
                    .replace(/\s+/g, '');

                let tvSymbol = '';

                if (asset.asset_class === 'crypto') {
                    if (!cleanSymbol.endsWith('USDT')) {
                        cleanSymbol += 'USDT';
                    }
                    tvSymbol = 'BINANCE:' + cleanSymbol;
                } else if (asset.asset_class === 'forex') {
                    tvSymbol = 'FX:' + cleanSymbol;
                } else if (asset.asset_class === 'index') {
                    tvSymbol = 'TVC:' + cleanSymbol;
                } else if (asset.asset_class === 'etf') {
                    tvSymbol = 'AMEX:' + cleanSymbol;
                } else {
                    tvSymbol = 'NASDAQ:' + cleanSymbol;
                }

                initChart(tvSymbol);
            },

            formatPrice(price) {
                if (!price) return '0.00';
                price = parseFloat(price);
                if (price >= 1) return price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                if (price >= 0.01) return price.toFixed(4);
                return price.toFixed(6);
            },

            confirmTrade(action) {
                if (!this.selectedAssetId) {
                    Swal.fire({ title: 'Select an Asset', text: 'Please choose an asset before placing a trade.', icon: 'info', background: '#161A1E', color: '#E8EAED' });
                    return;
                }
                if (!this.amount || this.amount <= 0) {
                    Swal.fire({ title: 'Enter Amount', text: 'Please enter a valid trade amount.', icon: 'info', background: '#161A1E', color: '#E8EAED' });
                    return;
                }

                const modeLabel = this.isDemo ? ' (DEMO)' : '';
                const typeLabel = this.tradeType === 'binary' ? 'Binary' : 'Spot';
                const profitLoss = (this.amount * this.leverage / 100).toFixed(2);

                const cs = '$';

                Swal.fire({
                    title: `Confirm ${action.toUpperCase()} ${typeLabel}${modeLabel}`,
                    html: `
                        <div style="text-align:left; font-size:13px; color:#9BA1A6;">
                            <p><strong>Asset:</strong> ${this.selectedAsset.symbol} — ${this.selectedAsset.name}</p>
                            <p><strong>Entry Price:</strong> ${cs}${this.formatPrice(this.selectedAsset.price)}</p>
                            <p><strong>Amount:</strong> ${cs}${Number(this.amount).toFixed(2)}</p>
                            <p><strong>Leverage:</strong> ${this.leverage}x</p>
                            ${this.tradeType === 'binary' ? '<p><strong>Duration:</strong> ' + this.durationOptions.find(d => d.value === this.duration)?.label + '</p>' : '<p><strong>Duration:</strong> No expiry (spot)</p>'}
                            <p><strong>Potential P/L:</strong> <span style="color:#22C55E">+${cs}${profitLoss}</span> / <span style="color:#EF4444">-${cs}${profitLoss}</span></p>
                        </div>
                    `,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: action === 'buy' ? '#22C55E' : '#EF4444',
                    cancelButtonColor: '#2A2F36',
                    confirmButtonText: `${action.toUpperCase()} Now`,
                    cancelButtonText: "Cancel",
                    background: '#161A1E',
                    color: '#E8EAED'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$refs.tradeAction.value = action;
                        document.getElementById('tradeForm').submit();
                    }
                });
            },
        };
    }
</script>
