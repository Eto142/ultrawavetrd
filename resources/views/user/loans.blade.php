
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

    
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Apply for a Loan</h2>
            <p class="text-sm text-content-secondary mt-1">Choose a plan, enter your details, and preview your repayment</p>
        </div>
        <a href="{{ route('user.loans.my') }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">
            My Loans
        </a>
    </div>

    
    
        <div x-data="loanCalculator()" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-2 space-y-4">
            <h3 class="text-sm font-semibold text-content-secondary uppercase tracking-wider">Available Plans</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($plans as $plan)
                    <div @click="selectPlan({{ $plan->toJson() }})"
                         :class="selectedPlan && selectedPlan.id === {{ $plan->id }} ? 'ring-2 ring-primary border-primary' : 'border-surface-border hover:border-primary/50'"
                         class="cursor-pointer rounded-xl bg-surface-raised border p-5 transition-all">
                        <div class="flex items-start justify-between mb-3">
                            <h4 class="font-semibold text-content-primary">{{ $plan->name }}</h4>
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-primary-subtle text-primary">
                                {{ number_format($plan->interest_rate, 2) }}% {{ ucfirst($plan->interest_type) }}
                            </span>
                        </div>
                        <p class="text-xs text-content-tertiary mb-3">{{ $plan->description }}</p>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-content-tertiary">Amount:</span>
                                <span class="text-content-secondary">${{ number_format($plan->min_amount, 2) }} – {{ number_format($plan->max_amount) }}</span>
                            </div>
                            <div>
                                <span class="text-content-tertiary">Duration:</span>
                                <span class="text-content-secondary">{{ $plan->min_duration }} – {{ $plan->max_duration }} mo</span>
                            </div>
                            <div>
                                <span class="text-content-tertiary">Fee:</span>
                                <span class="text-content-secondary">{{ number_format($plan->processing_fee, 2) }}%</span>
                            </div>
                            <div>
                                <span class="text-content-tertiary">Min Balance:</span>
                                <span class="text-content-secondary">${{ number_format($plan->min_account_balance, 2) }}</span>
                            </div>
                        </div>
                        @if ($plan->requires_collateral)
                            <div class="mt-2 text-xs text-warning">
                                Requires {{ number_format($plan->collateral_percentage, 2) }}% collateral
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            
            <div x-show="selectedPlan" x-cloak class="rounded-xl bg-surface-raised border border-surface-border p-6">
                <h3 class="text-sm font-semibold text-content-secondary uppercase tracking-wider mb-4">Loan Details</h3>
                <form action="{{ route('user.loans.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="loan_plan_id" :value="selectedPlan ? selectedPlan.id : ''">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Loan Amount ($)</label>
                            <input type="number" name="amount" x-model="amount" @input.debounce.300ms="fetchPreview()"
                                   :min="selectedPlan ? selectedPlan.min_amount : 0"
                                   :max="selectedPlan ? selectedPlan.max_amount : 0"
                                   step="0.01" required
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                                   :placeholder="selectedPlan ? 'Min: ' + Number(selectedPlan.min_amount).toLocaleString() : ''">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Duration (Months)</label>
                            <input type="number" name="duration" x-model="duration" @input.debounce.300ms="fetchPreview()"
                                   :min="selectedPlan ? selectedPlan.min_duration : 1"
                                   :max="selectedPlan ? selectedPlan.max_duration : 60"
                                   required
                                   class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                                   :placeholder="selectedPlan ? selectedPlan.min_duration + ' – ' + selectedPlan.max_duration + ' months' : ''">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Purpose of Loan</label>
                        <textarea name="purpose" rows="3" required
                                  class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary"
                                  placeholder="Describe why you need this loan..."></textarea>
                    </div>

                    <button type="submit" :disabled="!previewLoaded"
                            class="w-full py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Submit Application
                    </button>
                </form>
            </div>
        </div>

        
        <div class="space-y-4">
            <h3 class="text-sm font-semibold text-content-secondary uppercase tracking-wider">Repayment Preview</h3>
            <div class="rounded-xl bg-surface-raised border border-surface-border p-5 sticky top-4">
                <template x-if="!selectedPlan">
                    <p class="text-sm text-content-tertiary text-center py-4">Select a loan plan to see the preview.</p>
                </template>
                <template x-if="selectedPlan && !previewLoaded">
                    <div class="text-center py-4">
                        <p class="text-sm text-content-tertiary" x-show="loading">Calculating...</p>
                        <p class="text-sm text-content-tertiary" x-show="!loading && !previewLoaded">Enter amount and duration to see preview.</p>
                    </div>
                </template>
                <template x-if="selectedPlan && previewLoaded">
                    <div class="space-y-3">
                        <div class="text-center pb-3 border-b border-surface-border">
                            <p class="text-xs text-content-tertiary">Monthly Payment</p>
                            <p class="text-2xl font-bold text-primary">$<span x-text="Number(preview.monthly_payment).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})"></span></p>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-content-tertiary">Loan Amount</span>
                                <span class="text-content-primary font-medium">$<span x-text="Number(amount).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-content-tertiary">Interest (<span x-text="preview.interest_rate"></span>% <span x-text="preview.interest_type"></span>)</span>
                                <span class="text-content-primary font-medium">$<span x-text="Number(preview.total_interest).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-content-tertiary">Processing Fee</span>
                                <span class="text-content-primary font-medium">$<span x-text="Number(preview.processing_fee).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})"></span></span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-surface-border">
                                <span class="text-content-secondary font-semibold">Total Repayable</span>
                                <span class="text-content-primary font-bold">$<span x-text="Number(preview.total_repayable).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-content-tertiary">Duration</span>
                                <span class="text-content-primary font-medium"><span x-text="duration"></span> months</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            
            <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                <h4 class="text-xs font-semibold text-content-tertiary uppercase tracking-wider mb-3">Your Account</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-content-tertiary">Balance</span>
                        <span class="text-content-primary font-medium">$0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function loanCalculator() {
        return {
            selectedPlan: null,
            amount: '',
            duration: '',
            preview: {},
            previewLoaded: false,
            loading: false,

            selectPlan(plan) {
                this.selectedPlan = plan;
                this.amount = '';
                this.duration = '';
                this.preview = {};
                this.previewLoaded = false;
            },

            async fetchPreview() {
                if (!this.selectedPlan || !this.amount || !this.duration) {
                    this.previewLoaded = false;
                    return;
                }
                this.loading = true;
                try {
                    const resp = await fetch('{{ route('user.loans.preview') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            loan_plan_id: this.selectedPlan.id,
                            amount: this.amount,
                            duration: this.duration,
                        }),
                    });
                    if (resp.ok) {
                        this.preview = await resp.json();
                        this.previewLoaded = true;
                    } else {
                        this.previewLoaded = false;
                    }
                } catch (e) {
                    this.previewLoaded = false;
                }
                this.loading = false;
            }
        }
    }
    </script>
    
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
      







</body>
</html>

