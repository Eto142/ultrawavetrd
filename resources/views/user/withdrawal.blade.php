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
        bg-primary text-content-inverse">
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
    <h2 class="text-xl font-bold text-content-primary">Request Withdrawal</h2>
            <p class="text-sm text-content-secondary mt-1">Withdraw funds from your account</p>
    </div>

    <div class="max-w-3xl" x-data="withdrawalWizard()">

        
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <template x-for="(s, idx) in steps" :key="idx">
                    <div class="flex items-center" :class="idx < steps.length - 1 ? 'flex-1' : ''">
                        <div class="flex flex-col items-center">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300"
                                 :class="step > idx + 1 ? 'bg-primary text-content-inverse' : (step === idx + 1 ? 'bg-primary text-content-inverse ring-4 ring-primary/20' : 'bg-surface-overlay text-content-tertiary border border-surface-border')">
                                <template x-if="step > idx + 1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                </template>
                                <template x-if="step <= idx + 1">
                                    <span x-text="idx + 1"></span>
                                </template>
                            </div>
                            <span class="text-[10px] mt-1.5 font-medium whitespace-nowrap"
                                  :class="step >= idx + 1 ? 'text-primary' : 'text-content-tertiary'" x-text="s"></span>
                        </div>
                        <template x-if="idx < steps.length - 1">
                            <div class="flex-1 h-0.5 mx-3 mt-[-18px] rounded-full transition-all duration-300"
                                 :class="step > idx + 1 ? 'bg-primary' : 'bg-surface-border'"></div>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        <form method="POST" action="{{ route('user.withdrawal.store') }}" @submit="return validateFinal()">
            @csrf
            <input type="hidden" name="method_type" x-model="methodType">
            <input type="hidden" name="fee" :value="fees">
            <input type="hidden" name="total_deducted" :value="totalDeducted">

            <div x-show="step === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-content-primary">Select Withdrawal Method</h3>
                            <p class="text-xs text-content-tertiary">Choose how you'd like to receive your funds</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <label class="relative cursor-pointer group">
                                <input type="radio" name="method" value="USDT"
                                       data-methodtype="crypto"
                                       data-charges-type="percentage"
                                       data-charges-amount="0"
                                       data-minimum="100"
                                       x-model="selectedMethod"
                                       @change="onMethodSelect($event.target)"
                                       class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/5 border-surface-border hover:border-content-tertiary">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-surface-overlay flex items-center justify-center flex-shrink-0">
                                                                                            <svg class="w-5 h-5 text-content-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                                                                    </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-content-primary">USDT</p>
                                            <p class="text-[11px] text-content-tertiary">
                                                Fee: 0%
                                                &middot; Min: $100.00                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                                                    <label class="relative cursor-pointer group">
                                <input type="radio" name="method" value="Bank Transfer"
                                       data-methodtype="currency"
                                       data-charges-type="percentage"
                                       data-charges-amount="0"
                                       data-minimum="1000"
                                       x-model="selectedMethod"
                                       @change="onMethodSelect($event.target)"
                                       class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/5 border-surface-border hover:border-content-tertiary">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-surface-overlay flex items-center justify-center flex-shrink-0">
                                                                                            <svg class="w-5 h-5 text-content-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                                                                                    </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-content-primary">Bank Transfer</p>
                                            <p class="text-[11px] text-content-tertiary">
                                                Fee: 0%
                                                &middot; Min: $1,000.00                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                                                    <label class="relative cursor-pointer group">
                                <input type="radio" name="method" value="Ethereum"
                                       data-methodtype="crypto"
                                       data-charges-type="percentage"
                                       data-charges-amount="0"
                                       data-minimum="100"
                                       x-model="selectedMethod"
                                       @change="onMethodSelect($event.target)"
                                       class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/5 border-surface-border hover:border-content-tertiary">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-surface-overlay flex items-center justify-center flex-shrink-0">
                                                                                            <svg class="w-5 h-5 text-content-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                                                                    </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-content-primary">Ethereum</p>
                                            <p class="text-[11px] text-content-tertiary">
                                                Fee: 0%
                                                &middot; Min: $100.00                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                                                    <label class="relative cursor-pointer group">
                                <input type="radio" name="method" value="Bitcoin"
                                       data-methodtype="crypto"
                                       data-charges-type="percentage"
                                       data-charges-amount="0"
                                       data-minimum="100"
                                       x-model="selectedMethod"
                                       @change="onMethodSelect($event.target)"
                                       class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/5 border-surface-border hover:border-content-tertiary">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-surface-overlay flex items-center justify-center flex-shrink-0">
                                                                                            <svg class="w-5 h-5 text-content-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                                                                    </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-content-primary">Bitcoin</p>
                                            <p class="text-[11px] text-content-tertiary">
                                                Fee: 0%
                                                &middot; Min: $100.00                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                                            </div>

                    <p x-show="methodError" x-cloak class="text-xs text-loss mt-3">Please select a withdrawal method.</p>
                </div>
            </div>

            
            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" /></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-content-primary">Payment Details</h3>
                            <p class="text-xs text-content-tertiary">Enter your <span x-text="selectedMethod" class="font-medium text-content-secondary"></span> details</p>
                        </div>
                    </div>

                    
                    <div x-show="methodType === 'crypto'" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Wallet Address</label>
                            <input type="text" name="wallet_address" x-model="walletAddress"
                                   :placeholder="'Enter your ' + selectedMethod + ' wallet address'" autocomplete="off"
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <p x-show="detailsError" x-cloak class="text-xs text-loss">Please enter your wallet address.</p>
                    </div>

                    
                    <div x-show="methodType === 'currency'" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Bank Name</label>
                            <input type="text" name="bankname" x-model="bankName" maxlength="100" autocomplete="off" placeholder="Enter your bank name"
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Account Name</label>
                            <input type="text" name="account_name" x-model="accountName" maxlength="100" autocomplete="off" placeholder="Name on your account"
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Account Number</label>
                            <input type="number" name="account_number" x-model="accountNumber" autocomplete="off" placeholder="Enter your account number"
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Routing Number / SWIFT Code</label>
                            <input type="text" name="swift_code" x-model="swiftCode" maxlength="50" autocomplete="off" placeholder="Enter routing number or SWIFT/BIC code"
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <p x-show="detailsError" x-cloak class="text-xs text-loss">Please fill in all bank details.</p>
                    </div>
                </div>
            </div>

            
            <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-content-primary">Enter Amount</h3>
                            <p class="text-xs text-content-tertiary">Available balance: <span class="text-gain font-semibold">$0.00</span></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1.5">Withdrawal Amount ($)</label>
                            <input type="number" name="amount" x-model="amount" placeholder="0.00" step="0.01" min="0" autocomplete="off"
                                   @input="calculateFees()"
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>

                        
                        <div x-show="amount > 0" x-cloak class="bg-surface-overlay/50 rounded-lg p-4 space-y-2.5 border border-surface-border">
                            <div class="flex justify-between text-xs">
                                <span class="text-content-tertiary">Withdrawal Amount</span>
                                <span class="text-content-primary font-medium">$<span x-text="parseFloat(amount || 0).toFixed(2)"></span></span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-content-tertiary">Fee (<span x-text="feeLabel"></span>)</span>
                                <span class="text-warning font-medium">- $<span x-text="fees.toFixed(2)"></span></span>
                            </div>
                            <div class="border-t border-surface-border pt-2.5 flex justify-between text-sm">
                                <span class="text-content-secondary font-medium">Total Deducted</span>
                                <span class="text-content-primary font-semibold">$<span x-text="totalDeducted.toFixed(2)"></span></span>
                            </div>
                        </div>

                        <p x-show="amountError" x-cloak class="text-xs text-loss" x-text="amountError"></p>
                    </div>
                </div>
            </div>

            
            <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-content-primary">Review & Confirm</h3>
                            <p class="text-xs text-content-tertiary">Please verify the details before submitting</p>
                        </div>
                    </div>

                    <div class="bg-surface-overlay/50 rounded-lg border border-surface-border divide-y divide-surface-border">
                        <div class="flex justify-between px-4 py-3">
                            <span class="text-xs text-content-tertiary">Method</span>
                            <span class="text-sm font-medium text-content-primary" x-text="selectedMethod"></span>
                        </div>
                        <div class="px-4 py-3" x-show="methodType === 'crypto'">
                            <span class="text-xs text-content-tertiary">Wallet Address</span>
                            <p class="text-sm font-mono text-content-primary mt-0.5 break-all" x-text="walletAddress"></p>
                        </div>
                        <div x-show="methodType === 'currency'" class="px-4 py-3 space-y-1">
                            <span class="text-xs text-content-tertiary">Bank Details</span>
                            <p class="text-sm text-content-primary" x-text="bankName"></p>
                            <p class="text-xs text-content-secondary"><span x-text="accountName"></span> &middot; <span x-text="accountNumber"></span></p>
                            <p class="text-xs text-content-secondary" x-show="swiftCode">SWIFT/Routing: <span x-text="swiftCode" class="font-mono"></span></p>
                        </div>
                        <div class="flex justify-between px-4 py-3">
                            <span class="text-xs text-content-tertiary">Amount</span>
                            <span class="text-sm font-medium text-content-primary">$<span x-text="parseFloat(amount || 0).toFixed(2)"></span></span>
                        </div>
                        <div class="flex justify-between px-4 py-3">
                            <span class="text-xs text-content-tertiary">Fee</span>
                            <span class="text-sm font-medium text-warning">- $<span x-text="fees.toFixed(2)"></span></span>
                        </div>
                        <div class="flex justify-between px-4 py-3 bg-surface-overlay/30">
                            <span class="text-sm font-semibold text-content-primary">Total Deducted</span>
                            <span class="text-sm font-bold text-content-primary">$<span x-text="totalDeducted.toFixed(2)"></span></span>
                        </div>
                    </div>

                    <div class="mt-4 p-3 rounded-lg bg-warning/10 border border-warning/20">
                        <p class="text-xs text-content-primary">
                            <span class="font-semibold text-warning">Note:</span>
                            By confirming, the total amount (including fees) will be deducted from your account. Withdrawal requests are processed during business hours.
                        </p>
                    </div>
                </div>
            </div>

            
            <div class="flex items-center justify-between mt-6">
                <button type="button" x-show="step > 1" @click="step--"
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg border border-surface-border text-sm font-medium text-content-secondary hover:bg-surface-overlay transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    Back
                </button>
                <div x-show="step === 1" class="w-px"></div>

                <button type="button" x-show="step < 4" @click="nextStep()"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors ml-auto">
                    Continue
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </button>

                <button type="submit" x-show="step === 4" x-cloak
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-lg bg-gain hover:bg-gain/90 text-white text-sm font-semibold transition-colors ml-auto">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                    Confirm Withdrawal
                </button>
            </div>
        </form>
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
                    <input type="hidden" name="_token" value="rLwI7Fc9ZrLyHHXojFzEp8fc5cBgLpDmBdQGabCG">                    <input type="hidden" name="to_email" value="Ultrawavetrd Support">
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

    <script src="/livewire/livewire.js?id=90730a3b0e7144480175" data-turbo-eval="false" data-turbolinks-eval="false" ></script><script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '';window.livewire_token = 'rLwI7Fc9ZrLyHHXojFzEp8fc5cBgLpDmBdQGabCG';window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};let started = false;window.addEventListener('alpine:initializing', function () {if (! started) {window.livewire.start();started = true;}});document.addEventListener("DOMContentLoaded", function () {if (! started) {window.livewire.start();started = true;}});</script>
    <script>
    function withdrawalWizard() {
        return {
            step: 1,
            steps: ['Method', 'Details', 'Amount', 'Review'],
            selectedMethod: '',
            methodType: '',
            chargesType: '',
            chargesAmount: 0,
            minimum: 0,
            walletAddress: '',
            bankName: '',
            accountName: '',
            accountNumber: '',
            swiftCode: '',
            amount: '',
            fees: 0,
            totalDeducted: 0,
            feeLabel: '',
            methodError: false,
            detailsError: false,
            amountError: '',

            onMethodSelect(el) {
                this.methodType = el.getAttribute('data-methodtype');
                this.chargesType = el.getAttribute('data-charges-type');
                this.chargesAmount = parseFloat(el.getAttribute('data-charges-amount')) || 0;
                this.minimum = parseFloat(el.getAttribute('data-minimum')) || 0;
                this.methodError = false;
                this.calculateFees();
            },

            calculateFees() {
                const amt = parseFloat(this.amount) || 0;
                if (this.chargesType === 'percentage') {
                    this.fees = amt * this.chargesAmount / 100;
                    this.feeLabel = this.chargesAmount + '%';
                } else {
                    this.fees = this.chargesAmount;
                    this.feeLabel = 'fixed';
                }
                this.totalDeducted = amt + this.fees;
            },

            nextStep() {
                if (this.step === 1) {
                    if (!this.selectedMethod) { this.methodError = true; return; }
                    this.methodError = false;
                }
                if (this.step === 2) {
                    if (this.methodType === 'crypto' && !this.walletAddress.trim()) { this.detailsError = true; return; }
                    if (this.methodType === 'currency' && (!this.bankName.trim() || !this.accountName.trim() || !this.accountNumber || !this.swiftCode.trim())) { this.detailsError = true; return; }
                    this.detailsError = false;
                }
                if (this.step === 3) {
                    const amt = parseFloat(this.amount) || 0;
                    if (amt <= 0) { this.amountError = 'Please enter a valid amount.'; return; }
                    if (amt < this.minimum) { this.amountError = 'Minimum withdrawal is $' + this.minimum.toFixed(2); return; }
                    this.amountError = '';
                    this.calculateFees();
                }
                this.step++;
            },

            validateFinal() {
                return this.step === 4 && this.selectedMethod && this.amount > 0;
            }
        };
    }
</script>
 






</body>
</html>

