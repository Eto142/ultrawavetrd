@include('user.header')
    
    <main class="transition-all duration-200 lg:ml-64 pt-16 min-h-screen">
        
        <div x-data="{ toasts: [] }"
             x-init="
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
            
    
    
    
    <div>
    </div>    <div>
    </div>
    <div>
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

    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        
        <div class="lg:col-span-5 space-y-5">

            
            <div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-primary text-content-inverse">
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
    <!--<a href="{{ route('user.portfolio') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors-->
    <!--    bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">-->
    <!--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
</svg>
 Portfolio-->
    <!--</a>-->
    <!--<a href="{{ route('user.trade') }}s/positions" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors-->
    <!--    bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">-->
    <!--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
</svg>
 Positions-->
    <!--</a>-->
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
    <!--<button @click="$dispatch('open-mail-support')" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary transition-colors">-->
    <!--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
</svg>
 Support-->
    <!--</button>-->
</div>
            
            
            
            
            <div class="relative rounded-xl overflow-hidden group/hero">

    
    <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-primary/0 via-primary to-primary/0"></div>

    
    <div class="bg-gradient-to-br from-surface-raised via-surface-raised to-surface-overlay border border-surface-border rounded-xl p-5 sm:p-6 relative">

        
        <div class="absolute -top-20 -right-20 w-56 h-56 bg-primary/[0.04] rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-info/[0.03] rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute top-1/2 right-8 w-24 h-24 border border-primary/[0.06] rounded-full pointer-events-none hidden sm:block"></div>
        <div class="absolute top-1/3 right-16 w-12 h-12 border border-primary/[0.04] rounded-full pointer-events-none hidden sm:block"></div>

        
        <div class="flex items-center justify-between mb-4 relative">
            <div>
                <p class="text-xs text-content-tertiary font-medium mb-0.5">Welcome back,</p>
                <p class="text-sm font-semibold text-content-primary">egod </p>
            </div>

            <div class="flex items-center gap-2">
                
                                    <a href="{{ route('user.connect-wallet') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-primary bg-primary/10 border border-primary/20 px-3 py-1.5 rounded-full hover:bg-primary/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
                        Connect Wallet
                    </a>
                
                
                                                            <a href="{{ route('user.kyc') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-warning bg-warning/10 border border-warning/20 px-3 py-1.5 rounded-full hover:bg-warning/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
</svg>
                            Unverified
                        </a>
                                                </div>
        </div>

        
        <div class="h-px bg-gradient-to-r from-surface-border/0 via-surface-border to-surface-border/0 mb-5"></div>

        
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 relative mb-5 overflow-hidden">

            
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-2">
                    <div class="p-1.5 rounded-md bg-primary-subtle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
                    </div>
                    <span class="text-xs font-medium uppercase tracking-widest text-content-tertiary">Total Balance</span>
                </div>
                <p class="text-content-primary tracking-tight truncate">
                    <span class="text-base sm:text-2xl font-semibold text-content-secondary align-top">$</span><span class="text-2xl sm:text-4xl font-bold">{{ number_format($balance->total, 2) }}</span>
                </p>
            </div>

            
            <div class="bg-surface-overlay/40 border border-surface-border rounded-lg p-3 sm:p-3.5 flex items-center gap-3 sm:min-w-[220px] overflow-hidden">
                <div class="p-2 rounded-lg bg-gain/10 shrink-0 ring-1 ring-gain/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
</svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] text-content-tertiary font-medium uppercase tracking-widest mb-0.5">Profit / Loss</p>
                    <div class="flex items-baseline gap-1.5 sm:gap-2">
                        <span class="text-sm sm:text-lg font-bold text-content-primary truncate min-w-0">$0.00</span>
                                                    <span class="text-xs font-medium text-content-tertiary shrink-0">N/A</span>
                                            </div>
                </div>
            </div>

        </div>

        
        <div class="h-px bg-gradient-to-r from-surface-border/0 via-surface-border to-surface-border/0 mb-4"></div>

        
        <div class="flex items-center gap-2 sm:gap-3 relative">
            <a href="{{ route('user.deposit') }}" class="flex-1 flex items-center justify-center gap-1.5 bg-primary hover:bg-primary-dark text-content-inverse text-xs sm:text-sm font-medium py-2 sm:py-2.5 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
                Deposit
            </a>
            <a href="{{ route('user.withdrawal') }}" class="flex-1 flex items-center justify-center gap-1.5 bg-surface-overlay hover:bg-surface-border text-content-primary text-xs sm:text-sm font-medium py-2 sm:py-2.5 rounded-lg border border-surface-border transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
</svg>
                Withdraw
            </a>
                        <a href="{{ route('user.trade') }}" class="flex-1 flex items-center justify-center gap-1.5 bg-surface-overlay hover:bg-surface-border text-content-primary text-xs sm:text-sm font-medium py-2 sm:py-2.5 rounded-lg border border-surface-border transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
                Trade
            </a>
                    </div>
    </div>
</div>

            
            <div class="grid grid-cols-2 gap-3 overflow-hidden">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-gain/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Total Profit</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="${{ number_format($balance->profit, 2) }}">${{ number_format($balance->profit, 2) }}</p>
    </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-info/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-info" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Bonus</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="${{ number_format($balance->bonus, 2) }}">${{ number_format($balance->bonus, 2) }}</p>
    </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-warning/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-warning" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Referral Bonus</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="${{ number_format($balance->bonus, 2) }}">${{ number_format($balance->bonus, 2) }}</p>
    </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-loss/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-loss" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Withdrawals</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="${{ number_format($balance->withdrawn, 2) }}">${{ number_format($balance->withdrawn, 2) }}</p>
    </div>
            </div>

            
            <!---->
            <!--<a href="{{ route('user.trade') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse font-semibold text-sm py-3 rounded-xl transition-colors">-->
            <!--    Trade Now-->
            <!--</a>-->
            <!---->

            
                        <a href="{{ route('user.connect-wallet') }}"
               class="group relative block w-full overflow-hidden bg-surface-raised border border-primary/30 rounded-xl p-4 hover:border-primary/60 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-subtle group-hover:bg-primary/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-content-primary">Connect Wallet</p>
                            <p class="text-xs text-content-tertiary">Earn $3,000.00 daily</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-gain/10 text-gain">
                            <span class="w-1.5 h-1.5 rounded-full bg-gain animate-pulse"></span>
                            Active
                        </span>
                        <svg class="w-4 h-4 text-content-tertiary group-hover:text-primary group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
            </a>
            

            
            <!--<div class="bg-surface-raised border border-surface-border rounded-xl p-5">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <h3 class="text-sm font-semibold text-content-primary">Support</h3>
                    </div>
        <a href="{{ route('user.support') }}/create" class="inline-flex items-center gap-1 text-xs font-medium text-primary hover:text-primary-dark transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
 New Ticket
        </a>
    </div>

            <div class="text-center py-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-content-tertiary mx-auto mb-2" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
</svg>
            <p class="text-xs text-content-tertiary mb-3">Need help? Open a support ticket.</p>
            <a href="{{ route('user.support') }}/create"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-xs font-semibold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
 Create Ticket
            </a>
        </div>
    </div>
-->

            
            
            
            <!---->
            <!--<div class="bg-surface-raised border border-surface-border rounded-xl p-5">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
</svg>
            <h3 class="text-sm font-semibold text-content-primary">Top Expert Traders</h3>
        </div>
        <a href="{{ route('user.copy-trading') }}" class="text-xs text-primary hover:text-primary-dark transition-colors">View All</a>
    </div>

    <div class="space-y-3">
                    <a href="{{ route('user.copy-trading') }}/expert/7" class="group flex items-center gap-3 p-3 rounded-lg bg-surface-overlay/50 border border-transparent hover:border-primary/30 hover:bg-surface-overlay transition-all duration-200">
                
                <div class="relative flex-shrink-0">
                                            <img src="{{ url('/') }}/storage/app/public/experts/w7rvBcvM4y7NO9bnWNXk5A6MSlaco0rIJH36qlaA.jpg" alt="Abdullah Rasheed" class="w-10 h-10 rounded-full object-cover ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-gain rounded-full border-2 border-surface-raised"></span>
                </div>

                
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Abdullah Rasheed</h4>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="bg-primary/10 text-primary text-[10px] font-medium px-1.5 py-0.5 rounded">Mixed</span>
                        <span class="text-[10px] text-content-tertiary">78% win</span>
                    </div>
                </div>

                
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-bold text-gain">12.00%</p>
                    <p class="text-[10px] text-content-tertiary">daily ROI</p>
                </div>
            </a>
                    <a href="{{ route('user.copy-trading') }}/expert/5" class="group flex items-center gap-3 p-3 rounded-lg bg-surface-overlay/50 border border-transparent hover:border-primary/30 hover:bg-surface-overlay transition-all duration-200">
                
                <div class="relative flex-shrink-0">
                                            <img src="{{ url('/') }}/storage/app/public/experts/Pig6FQxoDQopSzBT2xsrbKrlQnHnk0Qh70ZEWHrN.jpg" alt="Andrew Kreiger" class="w-10 h-10 rounded-full object-cover ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-gain rounded-full border-2 border-surface-raised"></span>
                </div>

                
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Andrew Kreiger</h4>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="bg-primary/10 text-primary text-[10px] font-medium px-1.5 py-0.5 rounded">Mixed</span>
                        <span class="text-[10px] text-content-tertiary">95% win</span>
                    </div>
                </div>

                
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-bold text-gain">14.00%</p>
                    <p class="text-[10px] text-content-tertiary">daily ROI</p>
                </div>
            </a>
                    <a href="{{ route('user.copy-trading') }}/expert/6" class="group flex items-center gap-3 p-3 rounded-lg bg-surface-overlay/50 border border-transparent hover:border-primary/30 hover:bg-surface-overlay transition-all duration-200">
                
                <div class="relative flex-shrink-0">
                                            <img src="{{ url('/') }}/storage/app/public/experts/aXps1D2XJxOyBphvaIOIBVVPm7umALLmq4T4ePf6.jpg" alt="Andrei Neagu" class="w-10 h-10 rounded-full object-cover ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-gain rounded-full border-2 border-surface-raised"></span>
                </div>

                
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Andrei Neagu</h4>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="bg-primary/10 text-primary text-[10px] font-medium px-1.5 py-0.5 rounded">Mixed</span>
                        <span class="text-[10px] text-content-tertiary">66% win</span>
                    </div>
                </div>

                
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-bold text-gain">65.00%</p>
                    <p class="text-[10px] text-content-tertiary">daily ROI</p>
                </div>
            </a>
            </div>

    <a href="{{ route('user.copy-trading') }}" class="mt-4 flex items-center justify-center gap-1.5 py-2.5 rounded-lg bg-primary/10 text-primary text-xs font-semibold hover:bg-primary hover:text-content-inverse transition-all duration-200">
        Explore All Experts
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
    </a>
</div>
-->
            <!---->

        </div>

        
        <div class="lg:col-span-7 space-y-5">

            
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
    <div class="px-5 py-4 border-b border-surface-border flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
        <h3 class="text-sm font-semibold text-content-primary">Market Overview</h3>
    </div>

    <div class="p-4">
        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-thin">
            @forelse ($marketOverview as $index => $market)
                @php($isPositive = $market['change'] >= 0)
                <div class="flex-shrink-0 w-[180px] rounded-lg p-3.5 border transition-colors {{ $index === 0 ? 'bg-primary border-primary' : 'bg-surface-overlay border-surface-border hover:border-surface-border-light' }}">
                    <div class="flex items-center gap-2 mb-3">
                        <img src="{{ $market['image'] }}" alt="{{ $market['symbol'] }}" class="w-7 h-7 rounded-full flex-shrink-0">
                        <span class="text-xs font-semibold truncate {{ $index === 0 ? 'text-white' : 'text-content-primary' }}">{{ $market['symbol'] }}</span>
                        <span class="ml-auto flex items-center gap-0.5 text-[11px] font-medium {{ $index === 0 ? 'text-white/80' : ($isPositive ? 'text-gain' : 'text-loss') }}">
                            {{ $isPositive ? '↑' : '↓' }} {{ rtrim(rtrim(number_format(abs($market['change']), 2), '0'), '.') }}%
                        </span>
                    </div>
                    <p class="text-lg font-bold {{ $index === 0 ? 'text-white' : 'text-content-primary' }}">
                        ${{ number_format($market['price'], $market['price'] < 1 ? 6 : 2) }}
                    </p>
                </div>
            @empty
                <p class="text-sm text-content-tertiary">Market data is temporarily unavailable.</p>
            @endforelse
                    </div>
    </div>
</div>

            
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
    <div class="px-5 py-4 border-b border-surface-border flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-primary"></span>
        <h3 class="text-sm font-semibold text-content-primary">Featured Stocks</h3>
    </div>

    <div class="p-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div class="flex items-center gap-3 rounded-lg bg-surface-overlay border border-surface-border p-3 hover:border-surface-border-light transition-colors">
                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AAPL.png" alt="AAPL" class="w-8 h-8 rounded-lg flex-shrink-0 bg-white/5 p-0.5">
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-primary font-medium truncate">Apple Inc.</p>
                        <span class="text-[10px] text-content-tertiary uppercase">AAPL</span>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-content-primary">$321.66</p>
                        <span class="text-[10px] font-medium text-loss">
                            -1.3%
                        </span>
                    </div>
                </div>
                                            <div class="flex items-center gap-3 rounded-lg bg-surface-overlay border border-surface-border p-3 hover:border-surface-border-light transition-colors">
                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/MSFT.png" alt="MSFT" class="w-8 h-8 rounded-lg flex-shrink-0 bg-white/5 p-0.5">
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-primary font-medium truncate">Microsoft Corp.</p>
                        <span class="text-[10px] text-content-tertiary uppercase">MSFT</span>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-content-primary">$381.58</p>
                        <span class="text-[10px] font-medium text-loss">
                            -2.24%
                        </span>
                    </div>
                </div>
                                            <div class="flex items-center gap-3 rounded-lg bg-surface-overlay border border-surface-border p-3 hover:border-surface-border-light transition-colors">
                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/GOOG.png" alt="GOOGL" class="w-8 h-8 rounded-lg flex-shrink-0 bg-white/5 p-0.5">
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-primary font-medium truncate">Alphabet Inc.</p>
                        <span class="text-[10px] text-content-tertiary uppercase">GOOGL</span>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-content-primary">$317.69</p>
                        <span class="text-[10px] font-medium text-loss">
                            -7.13%
                        </span>
                    </div>
                </div>
                    </div>
    </div>
</div>

            
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
    <div class="px-5 py-4 border-b border-surface-border flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-info"></span>
        <h3 class="text-sm font-semibold text-content-primary">Featured Forex</h3>
    </div>

    <div class="p-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <div class="flex items-center gap-3 rounded-lg bg-surface-overlay border border-surface-border p-3 hover:border-surface-border-light transition-colors">
                                            <img src="https://hatscripts.github.io/circle-flags/flags/eu.svg" alt="EUR/USD" class="w-8 h-8 rounded-lg flex-shrink-0 bg-white/5 p-0.5">
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-primary font-medium truncate">Euro / US Dollar</p>
                        <span class="text-[10px] text-content-tertiary uppercase">EUR/USD</span>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-content-primary">$1.13853</p>
                        <span class="text-[10px] font-medium text-gain">
                            +0.07%
                        </span>
                    </div>
                </div>
                                            <div class="flex items-center gap-3 rounded-lg bg-surface-overlay border border-surface-border p-3 hover:border-surface-border-light transition-colors">
                                            <img src="https://hatscripts.github.io/circle-flags/flags/gb.svg" alt="GBP/USD" class="w-8 h-8 rounded-lg flex-shrink-0 bg-white/5 p-0.5">
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-primary font-medium truncate">British Pound / US Dollar</p>
                        <span class="text-[10px] text-content-tertiary uppercase">GBP/USD</span>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-content-primary">$1.33237</p>
                        <span class="text-[10px] font-medium text-gain">
                            +0.07%
                        </span>
                    </div>
                </div>
                                            <div class="flex items-center gap-3 rounded-lg bg-surface-overlay border border-surface-border p-3 hover:border-surface-border-light transition-colors">
                                            <img src="https://hatscripts.github.io/circle-flags/flags/us.svg" alt="USD/JPY" class="w-8 h-8 rounded-lg flex-shrink-0 bg-white/5 p-0.5">
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-primary font-medium truncate">US Dollar / Japanese Yen</p>
                        <span class="text-[10px] text-content-tertiary uppercase">USD/JPY</span>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-content-primary">$163.766</p>
                        <span class="text-[10px] font-medium text-loss">
                            -0.06%
                        </span>
                    </div>
                </div>
                    </div>
    </div>
</div>

            
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
    <div class="px-5 py-4 border-b border-surface-border flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-info"></span>
            <h3 class="text-sm font-semibold text-content-primary">Recent Transactions</h3>
        </div>
        <a href="{{ route('user.transactions') }}" class="text-xs text-primary hover:text-primary-light font-medium transition-colors">
            View All &rarr;
        </a>
    </div>

            <div class="px-5 py-10 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-content-tertiary mx-auto mb-2" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
</svg>
            <p class="text-xs text-content-tertiary">No Transactions</p>
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

    
            <div x-data="{ open: false, copied: false }"
         @open-deposit-21.window="open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        
        <div x-show="open" x-transition class="relative w-full max-w-md bg-surface-raised border border-surface-border rounded-xl shadow-2xl overflow-hidden">

            
            <div class="flex items-center justify-between px-6 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">Gift Card Deposit</h3>
                <button @click="open = false" class="p-1 rounded-lg text-content-tertiary hover:text-content-primary hover:bg-surface-overlay transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
                </button>
            </div>

            
            <div class="px-6 py-5 space-y-5">

                
                <div class="flex items-start gap-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=&bgcolor=1C2127&color=E8EAED"
                         alt="QR Code" class="w-24 h-24 rounded-lg border border-surface-border shrink-0">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-tertiary mb-1.5">Send Gift Card to this address</p>
                        <div class="bg-surface-overlay rounded-lg px-3 py-2 border border-surface-border">
                            <p class="text-xs font-mono text-content-primary break-all leading-relaxed"></p>
                        </div>
                        <button type="button"
                                @click="navigator.clipboard.writeText(''); copied = true; setTimeout(() => copied = false, 2000)"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125h-2.25" />
                            </svg>
                            <span x-show="!copied">Copy address</span>
                            <span x-show="copied" x-cloak class="text-gain">Copied!</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-surface-border/60"></div>

                
                <form action="{{ url('/') }}/savedeposit" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="_token" value="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">                    <input type="hidden" name="paymethd_method" value="Gift Card">
                    <input type="hidden" name="mode" value="Gift Card">

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" min="1" required placeholder="0.00"
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Proof of Payment</label>
                        <label class="flex items-center justify-center gap-2 w-full px-4 py-3 border border-dashed border-surface-border-light rounded-lg cursor-pointer hover:border-primary/40 hover:bg-primary/5 transition-colors group">
                            <svg class="w-4 h-4 text-content-tertiary group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-sm text-content-tertiary group-hover:text-content-secondary transition-colors">Choose file or drag here</span>
                            <input type="file" name="proof" required class="sr-only">
                        </label>
                    </div>

                    
                    <div class="flex gap-3 pt-1">
                        <button type="button" @click="open = false"
                                class="flex-1 bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Submit Deposit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
        <div x-data="{ open: false, copied: false }"
         @open-deposit-17.window="open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        
        <div x-show="open" x-transition class="relative w-full max-w-md bg-surface-raised border border-surface-border rounded-xl shadow-2xl overflow-hidden">

            
            <div class="flex items-center justify-between px-6 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">USDT Deposit</h3>
                <button @click="open = false" class="p-1 rounded-lg text-content-tertiary hover:text-content-primary hover:bg-surface-overlay transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
                </button>
            </div>

            
            <div class="px-6 py-5 space-y-5">

                
                <div class="flex items-start gap-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=-&bgcolor=1C2127&color=E8EAED"
                         alt="QR Code" class="w-24 h-24 rounded-lg border border-surface-border shrink-0">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-tertiary mb-1.5">Send USDT to this address</p>
                        <div class="bg-surface-overlay rounded-lg px-3 py-2 border border-surface-border">
                            <p class="text-xs font-mono text-content-primary break-all leading-relaxed">-</p>
                        </div>
                        <button type="button"
                                @click="navigator.clipboard.writeText('-'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125h-2.25" />
                            </svg>
                            <span x-show="!copied">Copy address</span>
                            <span x-show="copied" x-cloak class="text-gain">Copied!</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-surface-border/60"></div>

                
                <form action="{{ url('/') }}/savedeposit" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="_token" value="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">                    <input type="hidden" name="paymethd_method" value="USDT">
                    <input type="hidden" name="mode" value="USDT">

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" min="1" required placeholder="0.00"
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Proof of Payment</label>
                        <label class="flex items-center justify-center gap-2 w-full px-4 py-3 border border-dashed border-surface-border-light rounded-lg cursor-pointer hover:border-primary/40 hover:bg-primary/5 transition-colors group">
                            <svg class="w-4 h-4 text-content-tertiary group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-sm text-content-tertiary group-hover:text-content-secondary transition-colors">Choose file or drag here</span>
                            <input type="file" name="proof" required class="sr-only">
                        </label>
                    </div>

                    
                    <div class="flex gap-3 pt-1">
                        <button type="button" @click="open = false"
                                class="flex-1 bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Submit Deposit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
        <div x-data="{ open: false, copied: false }"
         @open-deposit-2.window="open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        
        <div x-show="open" x-transition class="relative w-full max-w-md bg-surface-raised border border-surface-border rounded-xl shadow-2xl overflow-hidden">

            
            <div class="flex items-center justify-between px-6 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">Ethereum Deposit</h3>
                <button @click="open = false" class="p-1 rounded-lg text-content-tertiary hover:text-content-primary hover:bg-surface-overlay transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
                </button>
            </div>

            
            <div class="px-6 py-5 space-y-5">

                
                <div class="flex items-start gap-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=-&bgcolor=1C2127&color=E8EAED"
                         alt="QR Code" class="w-24 h-24 rounded-lg border border-surface-border shrink-0">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-tertiary mb-1.5">Send Ethereum to this address</p>
                        <div class="bg-surface-overlay rounded-lg px-3 py-2 border border-surface-border">
                            <p class="text-xs font-mono text-content-primary break-all leading-relaxed">-</p>
                        </div>
                        <button type="button"
                                @click="navigator.clipboard.writeText('-'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125h-2.25" />
                            </svg>
                            <span x-show="!copied">Copy address</span>
                            <span x-show="copied" x-cloak class="text-gain">Copied!</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-surface-border/60"></div>

                
                <form action="{{ url('/') }}/savedeposit" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="_token" value="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">                    <input type="hidden" name="paymethd_method" value="Ethereum">
                    <input type="hidden" name="mode" value="Ethereum">

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" min="1" required placeholder="0.00"
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Proof of Payment</label>
                        <label class="flex items-center justify-center gap-2 w-full px-4 py-3 border border-dashed border-surface-border-light rounded-lg cursor-pointer hover:border-primary/40 hover:bg-primary/5 transition-colors group">
                            <svg class="w-4 h-4 text-content-tertiary group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-sm text-content-tertiary group-hover:text-content-secondary transition-colors">Choose file or drag here</span>
                            <input type="file" name="proof" required class="sr-only">
                        </label>
                    </div>

                    
                    <div class="flex gap-3 pt-1">
                        <button type="button" @click="open = false"
                                class="flex-1 bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Submit Deposit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
        <div x-data="{ open: false, copied: false }"
         @open-deposit-1.window="open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        
        <div x-show="open" x-transition class="relative w-full max-w-md bg-surface-raised border border-surface-border rounded-xl shadow-2xl overflow-hidden">

            
            <div class="flex items-center justify-between px-6 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">Bitcoin Deposit</h3>
                <button @click="open = false" class="p-1 rounded-lg text-content-tertiary hover:text-content-primary hover:bg-surface-overlay transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
                </button>
            </div>

            
            <div class="px-6 py-5 space-y-5">

                
                <div class="flex items-start gap-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=-&bgcolor=1C2127&color=E8EAED"
                         alt="QR Code" class="w-24 h-24 rounded-lg border border-surface-border shrink-0">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-content-tertiary mb-1.5">Send Bitcoin to this address</p>
                        <div class="bg-surface-overlay rounded-lg px-3 py-2 border border-surface-border">
                            <p class="text-xs font-mono text-content-primary break-all leading-relaxed">-</p>
                        </div>
                        <button type="button"
                                @click="navigator.clipboard.writeText('-'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125h-2.25" />
                            </svg>
                            <span x-show="!copied">Copy address</span>
                            <span x-show="copied" x-cloak class="text-gain">Copied!</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-surface-border/60"></div>

                
                <form action="{{ url('/') }}/savedeposit" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="_token" value="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">                    <input type="hidden" name="paymethd_method" value="Bitcoin">
                    <input type="hidden" name="mode" value="Bitcoin">

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Amount ($)</label>
                        <input type="number" name="amount" step="0.01" min="1" required placeholder="0.00"
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    
                    <div>
                        <label class="text-xs font-medium text-content-tertiary mb-1.5 block">Proof of Payment</label>
                        <label class="flex items-center justify-center gap-2 w-full px-4 py-3 border border-dashed border-surface-border-light rounded-lg cursor-pointer hover:border-primary/40 hover:bg-primary/5 transition-colors group">
                            <svg class="w-4 h-4 text-content-tertiary group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-sm text-content-tertiary group-hover:text-content-secondary transition-colors">Choose file or drag here</span>
                            <input type="file" name="proof" required class="sr-only">
                        </label>
                    </div>

                    
                    <div class="flex gap-3 pt-1">
                        <button type="button" @click="open = false"
                                class="flex-1 bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">
                            Submit Deposit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
        
    
    <div x-data="{ open: false }"
         @open-other-deposit.window="open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div x-show="open" x-transition.opacity class="absolute inset-0 bg-black/60" @click="open = false"></div>
        <div x-show="open" x-transition class="relative w-full max-w-md bg-surface-raised border border-surface-border rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-content-primary">Other Deposit Method</h3>
                    <button @click="open = false" class="text-content-tertiary hover:text-content-primary"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
</button>
                </div>
                <form method="POST" action="{{ url('/') }}/otherpayment" class="space-y-4">
                    <input type="hidden" name="_token" value="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Full Name</label>
                        <input type="text" name="name" value="egod" readonly
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Email</label>
                        <input type="email" name="email" value="egod1422@gmail.com" readonly
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Deposit Type</label>
                        <select name="mode" required
                                class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="" disabled selected>Select method</option>
                            <option value="Litecoin">Litecoin</option>
                            <option value="BANK TRANSFER">Bank Transfer</option>
                            <option value="BITCOIN CASH">Bitcoin Cash</option>
                            <option value="USDT">USDT</option>
                            <option value="PAYPAL">PayPal</option>
                            <option value="WESTERN UNION">Western Union</option>
                            <option value="SKRILL">Skrill</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Amount</label>
                        <input type="number" step="0.01" name="amount" required placeholder="0.00"
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="open = false" class="flex-1 bg-surface-overlay text-content-secondary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">Cancel</button>
                        <button type="submit" name="request_deposit" class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
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
                    <input type="hidden" name="_token" value="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">                    <input type="hidden" name="to_email" value="Ultrawavetrd Support">
                    <input type="hidden" name="email" value="egod1422@gmail.com">
                    <input type="hidden" name="name" value="egod">
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

    <script src="/livewire/livewire.js?id=90730a3b0e7144480175" data-turbo-eval="false" data-turbolinks-eval="false" ></script><script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '';window.livewire_token = '4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d';window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};let started = false;window.addEventListener('alpine:initializing', function () {if (! started) {window.livewire.start();started = true;}});document.addEventListener("DOMContentLoaded", function () {if (! started) {window.livewire.start();started = true;}});</script>
      








</body>
</html>

