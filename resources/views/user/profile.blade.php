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
    </div><div>
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
        bg-primary text-content-inverse">
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
    <h2 class="text-xl font-bold text-content-primary">Account Settings</h2>
            <p class="text-sm text-content-secondary mt-1">Manage your profile &amp; security</p>
    </div>


<div class="rounded-xl bg-surface-raised border border-surface-border p-6 mb-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">

        <div class="relative shrink-0">
            <img src="{{ $user->avatarUrl() }}"
                 alt="{{ $user->name }}"
                 class="w-20 h-20 rounded-full border-2 border-primary object-cover bg-surface-overlay">
        </div>

        <div class="flex-1 min-w-0">
            <h2 class="text-xl font-bold text-content-primary">{{ $user->name }}</h2>
            <p class="text-sm text-content-secondary mt-0.5">{{ $user->email }}</p>
            <div class="flex items-center gap-2 mt-2">
                @if ($user->isKycApproved())
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-gain/10 text-gain text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
</svg>
                        Verified
                    </span>
                @elseif ($user->isKycPending())
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-warning/10 text-warning text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
                        Pending Review
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-warning/10 text-warning text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
</svg>
                        Not Verified
                    </span>
                @endif
            </div>
        </div>

        <div class="flex gap-6 text-center sm:text-right">
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Profit</p>
                <p class="text-lg font-bold {{ $stats['total_pnl'] > 0 ? 'text-gain' : ($stats['total_pnl'] < 0 ? 'text-loss' : 'text-content-primary') }}">{{ ($stats['total_pnl'] >= 0 ? '' : '-') . '$' . number_format(abs($stats['total_pnl']), 2) }}</p>
            </div>
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Balance</p>
                <p class="text-lg font-bold text-content-primary">${{ number_format($stats['deposits']['total'] - $stats['withdrawals']['total'], 2) }}</p>
            </div>
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Bonus</p>
                <p class="text-lg font-bold text-content-primary">$0.00</p>
            </div>
        </div>
    </div>
</div>


<div x-data="{ tab: 'profile' }" class="space-y-6">

    
    <div class="flex gap-1 border-b border-surface-border">
        <button @click="tab = 'profile'"
                :class="tab === 'profile' ? 'border-primary text-primary' : 'border-transparent text-content-tertiary hover:text-content-secondary'"
                class="px-4 py-3 text-sm font-medium border-b-2 transition-colors -mb-px">
            Personal Profile
        </button>
        <button @click="tab = 'records'"
                :class="tab === 'records' ? 'border-primary text-primary' : 'border-transparent text-content-tertiary hover:text-content-secondary'"
                class="px-4 py-3 text-sm font-medium border-b-2 transition-colors -mb-px">
            Account Records
        </button>
        <button @click="tab = 'settings'"
                :class="tab === 'settings' ? 'border-primary text-primary' : 'border-transparent text-content-tertiary hover:text-content-secondary'"
                class="px-4 py-3 text-sm font-medium border-b-2 transition-colors -mb-px">
            Account Settings
        </button>
    </div>

    
    
    
    <div x-show="tab === 'profile'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <form method="POST" action="{{ route('user.profile.update') }}" class="rounded-xl bg-surface-raised border border-surface-border p-6">
            @csrf
            <h3 class="text-lg font-semibold text-content-primary mb-6">Personal Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="md:col-span-2">
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" readonly
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Username</label>
                    <input type="text" value="{{ $user->username }}" readonly
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary/60 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Email Address</label>
                    <input type="email" value="{{ $user->email }}" readonly
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary/60 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Phone Number</label>
                    <input type="text" value="{{ $user->phone }}" readonly
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary/60 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Country</label>
                    <input type="text" name="country" value="{{ $user->country }}"
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Preferred Currency</label>
                    <select name="currency_code"
                            class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                    @foreach (config('currencies') as $code => $label)
                        <option value="{{ $code }}" {{ $user->currency_code === $code ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                                            </select>
                    <p class="mt-1 text-xs text-content-tertiary">Amounts will be displayed in this currency</p>
                </div>

                
                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">State / Province</label>
                    <input type="text" name="state" value="{{ $user->state }}"
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                </div>


                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Postal / Zip Code</label>
                    <input type="text" name="zipcode" value="{{ $user->zipcode }}"
                           class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                </div>


                <div class="md:col-span-2">
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Address</label>
                    <textarea name="address" rows="3"
                              class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition resize-none">{{ $user->address }}</textarea>
                </div>
            </div>


            <div class="mt-6 p-4 rounded-lg bg-surface-overlay border border-surface-border-light">
                <div class="flex flex-wrap gap-6">
                    <div>
                        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Account Status</p>
                        @if ($user->isKycApproved())
                            <span class="text-sm text-gain font-medium">Verified</span>
                        @else
                            <span class="text-sm text-warning font-medium">{{ $user->kycStatusLabel() }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6 pt-6 border-t border-surface-border">
                <button type="submit" name="client_update_info"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-primary text-content-inverse font-semibold hover:bg-primary-dark transition">
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    
    
    
    <div x-show="tab === 'records'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="space-y-6">

            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-primary-subtle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Net Worth</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="${{ number_format($stats['net_worth'], 2) }}">${{ number_format($stats['net_worth'], 2) }}</p>
    </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-info/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-info" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Total Invested</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="${{ number_format($stats['total_invested'], 2) }}">${{ number_format($stats['total_invested'], 2) }}</p>
    </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-gain/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Total P/L</p>
    <p class="text-[15px] sm:text-2xl font-bold {{ $stats['total_pnl'] > 0 ? 'text-gain' : ($stats['total_pnl'] < 0 ? 'text-loss' : 'text-content-primary') }} truncate" title="{{ $stats['total_pnl'] >= 0 ? '+' : '-' }}${{ number_format(abs($stats['total_pnl']), 2) }}">{{ $stats['total_pnl'] >= 0 ? '+' : '-' }}${{ number_format(abs($stats['total_pnl']), 2) }}</p>
    </div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 hover:border-surface-border-light transition-colors group min-w-0 overflow-hidden">
    <div class="flex items-start justify-between mb-3">
        <div class="p-2.5 rounded-lg bg-primary-subtle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
        </div>
    </div>
    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Win Rate</p>
    <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate" title="{{ $stats['win_rate'] === null ? 'N/A' : $stats['win_rate'] . '%' }}">{{ $stats['win_rate'] === null ? 'N/A' : $stats['win_rate'] . '%' }}</p>
    </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                
                <div class="lg:col-span-2 rounded-xl bg-surface-raised border border-surface-border p-5">
                    <h4 class="text-sm font-semibold text-content-primary mb-4">Portfolio Allocation</h4>
                    @if ($stats['allocation']->isEmpty())
                        <div class="flex items-center justify-center h-48">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-content-tertiary mx-auto mb-2" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
                                <p class="text-sm text-content-tertiary">No allocations yet</p>
                                <p class="text-xs text-content-tertiary mt-1">Start trading or investing to see your breakdown</p>
                            </div>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($stats['allocation'] as $label => $amount)
                                <div>
                                    <div class="flex items-center justify-between text-xs mb-1">
                                        <span class="text-content-secondary">{{ $label }}</span>
                                        <span class="text-content-primary font-medium">{{ round($amount / $stats['allocation_total'] * 100) }}%</span>
                                    </div>
                                    <div class="w-full h-1.5 rounded-full bg-surface-overlay overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: {{ round($amount / $stats['allocation_total'] * 100) }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-3 rounded-xl bg-surface-raised border border-surface-border p-5">
                    <h4 class="text-sm font-semibold text-content-primary mb-4">Breakdown</h4>

                    @if ($stats['allocation']->isEmpty())
                        <p class="text-sm text-content-tertiary">No active allocations to display.</p>
                    @else
                        <div class="space-y-2">
                            @foreach ($stats['allocation'] as $label => $amount)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-content-secondary">{{ $label }}</span>
                                    <span class="text-content-primary font-medium">${{ number_format($amount, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-5 pt-4 border-t border-surface-border grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[10px] text-content-tertiary font-medium uppercase tracking-widest mb-0.5">Balance</p>
                            <p class="text-sm font-bold text-content-primary">${{ number_format($stats['deposits']['total'] - $stats['withdrawals']['total'], 2) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-content-tertiary font-medium uppercase tracking-widest mb-0.5">Profit</p>
                            <p class="text-sm font-bold {{ $stats['total_pnl'] >= 0 ? 'text-gain' : 'text-loss' }}">${{ number_format($stats['total_pnl'], 2) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-content-tertiary font-medium uppercase tracking-widest mb-0.5">Bonus</p>
                            <p class="text-sm font-bold text-content-primary">$0.00</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-content-tertiary font-medium uppercase tracking-widest mb-0.5">Referral</p>
                            <p class="text-sm font-bold text-content-primary">$0.00</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Trading</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['trading']['total_trades'] }} total trades</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Open</p>
                            <p class="text-base font-bold text-content-primary">{{ $stats['trading']['open'] }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Invested</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['trading']['invested'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Total Profit</p>
                            <p class="text-base font-bold text-gain">+${{ number_format($stats['trading']['profit'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Total Loss</p>
                            <p class="text-base font-bold text-loss">-${{ number_format($stats['trading']['loss'], 2) }}</p>
                        </div>
                    </div>
                </div>
                
                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-warning/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-warning" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m0 0a9.06 9.06 0 0 1 1.5-.124H15a3.375 3.375 0 0 1 3.375 3.375v1.5" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Copy Trading</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['copy_trading']['active'] }} active positions</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Invested</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['copy_trading']['invested'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Profit</p>
                            <p class="text-base font-bold text-gain">+${{ number_format($stats['copy_trading']['profit'], 2) }}</p>
                        </div>
                    </div>
                </div>
                
                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-info/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-info" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Investment Plans</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['investments']['active'] }} active plans</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Invested</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['investments']['invested'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Earned</p>
                            <p class="text-base font-bold text-gain">+${{ number_format($stats['investments']['earned'], 2) }}</p>
                        </div>
                    </div>
                </div>
                
                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-gain/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Pre-IPO</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['pre_ipo']['holdings'] }} holdings</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Cost</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['pre_ipo']['cost'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Value</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['pre_ipo']['value'], 2) }}</p>
                        </div>
                    </div>
                </div>
                
                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-[#8B5CF6]/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#8B5CF6]" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Stock Shares</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['stocks']['positions'] }} positions</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Invested</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['stocks']['invested'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Value</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['stocks']['value'], 2) }}</p>
                        </div>
                    </div>
                </div>
                
                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-[#EC4899]/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#EC4899]" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">NFTs</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['nfts']['owned'] }} owned</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Collection Value</p>
                            <p class="text-base font-bold text-content-primary">${{ number_format($stats['nfts']['value'], 2) }}</p>
                        </div>
                        <div class="bg-surface-overlay rounded-lg p-3">
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Items</p>
                            <p class="text-base font-bold text-content-primary">{{ $stats['nfts']['owned'] }}</p>
                        </div>
                    </div>
                </div>
                            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-gain/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Deposits</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['deposits']['count'] }} transactions</p>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-content-primary">${{ number_format($stats['deposits']['total'], 2) }}</p>
                    <p class="text-xs text-content-tertiary mt-1">Total deposited (processed)</p>
                </div>

                
                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-loss/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-loss" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Withdrawals</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['withdrawals']['count'] }} transactions</p>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-content-primary">${{ number_format($stats['withdrawals']['total'], 2) }}</p>
                    <p class="text-xs text-content-tertiary mt-1">Total withdrawn (processed)</p>
                </div>

                
                                <div class="rounded-xl bg-surface-raised border border-surface-border p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 rounded-lg bg-warning/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-warning" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 0 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712.75.75 0 0 0-.75-.75 2.25 2.25 0 0 1-.75-.127v0a2.25 2.25 0 0 1-1.5-2.123V4.575" />
</svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-content-primary">Loans</h4>
                            <p class="text-xs text-content-tertiary">{{ $stats['loans']['active'] }} active</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Outstanding</p>
                            <p class="text-base font-bold text-warning">${{ number_format($stats['loans']['outstanding'], 2) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-content-tertiary uppercase tracking-widest mb-0.5">Repaid</p>
                            <p class="text-base font-bold text-gain">${{ number_format($stats['loans']['repaid'], 2) }}</p>
                        </div>
                    </div>
                </div>
                            </div>

        </div>
    </div>

    
    
    
    <div x-show="tab === 'settings'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            
            <div class="rounded-xl bg-surface-raised border border-surface-border p-6">
                <h3 class="text-lg font-semibold text-content-primary mb-1">Change Password</h3>
                <p class="text-xs text-content-tertiary mb-5">You will be logged out after changing your password.</p>

                <form method="POST" action="{{ route('user.profile.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Current Password</label>
                        <input type="password" name="current_password" required autocomplete="off"
                               class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">New Password</label>
                        <input type="password" name="password" required autocomplete="off"
                               class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required autocomplete="off"
                               class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-content-inverse text-sm font-semibold hover:bg-primary-dark transition">
                            Change Password
                        </button>
                        <button type="reset"
                                class="px-5 py-2.5 rounded-lg border border-surface-border-light text-content-secondary text-sm font-medium hover:border-surface-border hover:text-content-primary transition">
                            Clear
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="rounded-xl bg-surface-raised border border-surface-border p-6">
                <h3 class="text-lg font-semibold text-content-primary mb-1">Change Profile Image</h3>
                <p class="text-xs text-content-tertiary mb-5">Upload a new profile photo.</p>

                <form method="POST" action="{{ route('user.profile.avatar') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="flex justify-center">
                        <img src="{{ $user->avatarUrl() }}"
                             alt="{{ $user->name }}"
                             class="w-32 h-32 rounded-full border-2 border-surface-border-light object-cover bg-surface-overlay">
                    </div>

                    <input type="file" name="profileimage" accept="image/*"
                           class="block w-full text-sm text-content-secondary file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">

                    <div class="pt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-content-inverse text-sm font-semibold hover:bg-primary-dark transition">
                            Change Profile Image
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="rounded-xl bg-surface-raised border border-surface-border p-6">
        <h3 class="text-sm font-semibold text-content-primary mb-3">Your Referral Link</h3>
        <div x-data="{ copied: false }" class="flex items-stretch gap-2">
            <input type="text" id="referral_link" value="{{ route('ref.redirect', $user->referral_code) }}" readonly
                   class="flex-1 bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary font-mono select-all focus:outline-none">
            <button @click="navigator.clipboard.writeText(document.getElementById('referral_link').value); copied = true; setTimeout(() => copied = false, 2000)"
                    class="px-5 rounded-lg bg-primary text-content-inverse text-sm font-semibold hover:bg-primary-dark transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m0 0a9.06 9.06 0 0 1 1.5-.124H15a3.375 3.375 0 0 1 3.375 3.375v1.5" />
</svg>
                <span x-text="copied ? 'Copied!' : 'Copy Link'"></span>
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
                    <input type="hidden" name="_token" value="33urHJ6yXCmJ10M5P6VQb1q8wXyBAhRpUNl6CGKT">                    <div>
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
                    <input type="hidden" name="_token" value="33urHJ6yXCmJ10M5P6VQb1q8wXyBAhRpUNl6CGKT">                    <input type="hidden" name="to_email" value="Ultrawavetrd Support">
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

    <script src="/livewire/livewire.js?id=90730a3b0e7144480175" data-turbo-eval="false" data-turbolinks-eval="false" ></script><script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '';window.livewire_token = '33urHJ6yXCmJ10M5P6VQb1q8wXyBAhRpUNl6CGKT';window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};let started = false;window.addEventListener('alpine:initializing', function () {if (! started) {window.livewire.start();started = true;}});document.addEventListener("DOMContentLoaded", function () {if (! started) {window.livewire.start();started = true;}});</script>
     







</body>
</html>

