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
    <div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
</svg>
 Dashboard
    </a>
    <a href="{{ route('user.deposit') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-primary text-content-inverse">
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

    <div class="mb-6">
    <h2 class="text-xl font-bold text-content-primary">Deposit Funds</h2>
            <p class="text-sm text-content-secondary mt-1">Select a payment method to fund your account</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">Crypto Deposits</h3>
            </div>
            <div class="divide-y divide-surface-border">
                                <div class="p-5 hover:bg-surface-overlay/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1.png" alt="Bitcoin" class="w-10 h-10 rounded-lg object-contain bg-surface-overlay p-1">
                                                        <div>
                                <h4 class="text-sm font-semibold text-content-primary mb-1">Bitcoin</h4>
                                <p class="text-xs text-primary">Upload payment proof for quick verification</p>
                            </div>
                        </div>
                        <button @click="$dispatch('open-deposit-1')"
                                class="bg-primary hover:bg-primary-dark text-content-inverse px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Deposit
                        </button>
                    </div>
                </div>
                                <div class="p-5 hover:bg-surface-overlay/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1027.png" alt="Ethereum" class="w-10 h-10 rounded-lg object-contain bg-surface-overlay p-1">
                                                        <div>
                                <h4 class="text-sm font-semibold text-content-primary mb-1">Ethereum</h4>
                                <p class="text-xs text-primary">Upload payment proof for quick verification</p>
                            </div>
                        </div>
                        <button @click="$dispatch('open-deposit-2')"
                                class="bg-primary hover:bg-primary-dark text-content-inverse px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Deposit
                        </button>
                    </div>
                </div>
                                <div class="p-5 hover:bg-surface-overlay/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/825.png" alt="USDT" class="w-10 h-10 rounded-lg object-contain bg-surface-overlay p-1">
                                                        <div>
                                <h4 class="text-sm font-semibold text-content-primary mb-1">USDT</h4>
                                <p class="text-xs text-primary">Upload payment proof for quick verification</p>
                            </div>
                        </div>
                        <button @click="$dispatch('open-deposit-17')"
                                class="bg-primary hover:bg-primary-dark text-content-inverse px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Deposit
                        </button>
                    </div>
                </div>
                                <div class="p-5 hover:bg-surface-overlay/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7yeAiby-NUQCieOSFDhpTUeqMQmAzNgumFQNko2YI2Q&amp;s" alt="Gift Card" class="w-10 h-10 rounded-lg object-contain bg-surface-overlay p-1">
                                                        <div>
                                <h4 class="text-sm font-semibold text-content-primary mb-1">Gift Card</h4>
                                <p class="text-xs text-primary">Upload payment proof for quick verification</p>
                            </div>
                        </div>
                        <button @click="$dispatch('open-deposit-21')"
                                class="bg-primary hover:bg-primary-dark text-content-inverse px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Deposit
                        </button>
                    </div>
                </div>
                            </div>
        </div>

        
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">Other Deposit Options</h3>
            </div>
            <div class="p-5">
                <div class="bg-surface-overlay border border-surface-border rounded-lg p-4 mb-4">
                    <p class="text-sm text-warning mb-2">Flexible payment methods available</p>
                    <p class="text-xs text-content-secondary leading-relaxed">
                        Once payment is made, send your proof to
                        <a href="mailto:support@Ultrawavetrd.live" class="text-primary hover:text-primary-light">support@Ultrawavetrd.live</a>.
                        You will receive payment details via support email.
                    </p>
                </div>
                <button @click="$dispatch('open-other-deposit')"
                        class="w-full bg-primary hover:bg-primary-dark text-content-inverse py-3 rounded-lg text-sm font-medium transition-colors">
                    Request Deposit
                </button>
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

                
                <form action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="method" value="Gift Card">

                    
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

                
                <form action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="method" value="USDT">

                    
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

                
                <form action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="method" value="Ethereum">

                    
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

                
                <form action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="method" value="Bitcoin">

                    
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
                <form method="POST" action="{{ route('user.deposit.other') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Full Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" readonly
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" readonly
                               class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Deposit Type</label>
                        <select name="method" required
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
                    <input type="hidden" name="_token" value="BvBJRLyM53UrJUZjlVROWOSlW2O4jwSpE5wkHBg2">                    <input type="hidden" name="to_email" value="Ultrawavetrd Support">
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

    <script src="/livewire/livewire.js?id=90730a3b0e7144480175" data-turbo-eval="false" data-turbolinks-eval="false" ></script><script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '';window.livewire_token = 'BvBJRLyM53UrJUZjlVROWOSlW2O4jwSpE5wkHBg2';window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};let started = false;window.addEventListener('alpine:initializing', function () {if (! started) {window.livewire.start();started = true;}});document.addEventListener("DOMContentLoaded", function () {if (! started) {window.livewire.start();started = true;}});</script>
      








</body>
</html>

