<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d">
    <title>Account Dashboard — Ultrawavetrd</title>
    <link rel="icon" href="{{ url('/') }}/storage/app/public/photos/photos/ZO47mJRZQWecg1WB4wWXp7hVtMvbRWiHdtXxGc4Q.png" type="image/png">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                },
                colors: {
                    surface: {
                        base: '#0D0F14',
                        raised: '#161A23',
                        overlay: '#1C2127',
                        border: '#2A2F36',
                        'border-light': '#363C44',
                    },
                    content: {
                        primary: '#EDEDED',
                        secondary: '#A1A1AA',
                        tertiary: '#6B7280',
                        inverse: '#0D0F14',
                    },
                    primary: {
                        DEFAULT: '#1473EA',
                        light: '#4DA3FF',
                        dark: '#0B5BC4',
                        subtle: 'rgba(20,115,234,0.12)',
                    },
                    gain: '#00C896',
                    loss: '#FF4D4F',
                    warning: '#1473EA',
                    info: '#3B82F6',
                    info: '#3B82F6',
                },
            },
        },
    }
    </script>
    <style type="text/tailwindcss">
    @layer  base {
        [x-cloak] { display: none !important; }
        html { background-color: #0F1115; }
        body { font-family: 'Inter', system-ui, sans-serif; color: #9AA0AB; -webkit-font-smoothing: antialiased; }
        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0F1115; }
        ::-webkit-scrollbar-thumb { background: #2A2F36; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #363C44; }
    }
    @layer  components {
        .nav-link-active {
            @apply  bg-primary-subtle text-primary-light border-l-2 border-primary;
        }
        .nav-link-item {
            @apply  flex items-center gap-3 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors duration-150 border-l-2 border-transparent;
        }
        .nav-group-label {
            @apply  px-4 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-content-tertiary;
        }
    }
    </style>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style >[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
</head>

<body class="bg-surface-base font-sans text-content-secondary antialiased min-h-screen"
      x-data="{
          sidebarOpen: window.innerWidth >= 1024,
          mobileSidebar: false,
          userDropdown: false,
          notifDropdown: false,
      }"
      @resize.window="sidebarOpen = window.innerWidth >= 1024; if(window.innerWidth >= 1024) mobileSidebar = false"
>
    
    <div x-show="mobileSidebar" x-transition.opacity class="fixed inset-0 bg-black/60 z-40 lg:hidden" @click="mobileSidebar = false"></div>

    
    <aside
        :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed top-0 left-0 z-50 h-full w-64 bg-surface-raised border-r border-surface-border flex flex-col transition-transform duration-200 ease-in-out -translate-x-full lg:translate-x-0"
    >
        
        <div class="flex items-center justify-between h-16 px-4 border-b border-surface-border shrink-0">
            <a href="{{route('user.dashboard')}}" class="flex items-center">
                <img src="{{ asset('logo.png') }}" alt="Ultrawavetrd" class="h-8 w-auto max-w-[140px] object-contain">
            </a>
            <button @click="mobileSidebar = false" class="lg:hidden text-content-tertiary hover:text-content-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
            </button>
        </div>

        
        <div class="px-4 py-4 border-b border-surface-border shrink-0">
            <div class="flex items-center gap-3">
                                    <img src="{{ Auth::user()->avatarUrl() }}"
                         alt="{{Auth::user()->name}}"
                         class="w-10 h-10 rounded-full object-cover bg-surface-overlay shrink-0">
                                <div class="min-w-0">
                    <p class="text-sm font-medium text-content-primary truncate">{{Auth::user()->name}}</p>
                                        <p class="text-xs {{ Auth::user()->isKycApproved() ? 'text-gain' : 'text-content-tertiary' }}">
                        {{ Auth::user()->kycStatusLabel() }}
                    </p>
                                    </div>
            </div>
        </div>

        
        <nav class="flex-1 overflow-y-auto py-2">
            
            <p class="nav-group-label">Overview</p>
            <a href="{{route('user.dashboard')}}" class="nav-link-item nav-link-active">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
</svg>
 Dashboard
            </a>
            <!--<a href="{{route('user.portfolio')}}" class="nav-link-item ">-->
            <!--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
</svg>
 Portfolio-->
            <!--</a>-->

            
            <p class="nav-group-label">Wallet</p>
            <a href="{{route('user.deposit')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
 Deposits
            </a>
                        <a href="{{route('user.withdrawal')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
</svg>
 Withdrawals
            </a>
                        <a href="{{route('user.transactions')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
</svg>
 Transactions
            </a>
                        <a href="{{route('user.loans')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 0 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712.75.75 0 0 0-.75-.75 2.25 2.25 0 0 1-.75-.127v0a2.25 2.25 0 0 1-1.5-2.123V4.575" />
</svg>
 Loans
            </a>
                        
            
            <p class="nav-group-label">Investments</p>
                        <a href="{{route('user.investment.plan')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
</svg>
 Investment Plans
            </a>
                                    <a href="{{route('user.pre-ipo')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
</svg>
 Pre-IPO
            </a>
                                    <a href="{{route('user.stocks')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
 Stock Shares
            </a>
                                    <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full nav-link-item flex items-center justify-between ">
                    <span class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>
 Trading Signals</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </button>
                <div x-show="open" x-transition x-cloak class="ml-8 space-y-0.5 mt-0.5">
                    <a href="{{route('user.signals')}}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Signals</a>
                    <a href="{{route('user.signal-plans')}}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Signal Plans</a>
                    <a href="{{route('user.my-subscriptions')}}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">My Subscriptions</a>
                </div>
            </div>
                                    <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full nav-link-item flex items-center justify-between ">
                    <span class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
</svg>
 NFT Market</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </button>
                <div x-show="open" x-transition x-cloak class="ml-8 space-y-0.5 mt-0.5">
                    <a href="{{route('user.nft-gallery')}}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Gallery</a>
                    <a href="{{route('user.my-collection')}}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">My Collection</a>
                    <a href="{{route('user.mint-nft')}}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Mint NFT</a>
                </div>
            </div>
            
            
            <p class="nav-group-label">Trading</p>
                        <a href="{{route('user.trade')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
</svg>
 Open Trade
            </a>
            <a href="{{route('user.markets')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5a17.92 17.92 0 0 1-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
</svg>
 Markets
            </a>
                                    <a href="{{route('user.copy-trading')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m0 0a9.06 9.06 0 0 1 1.5-.124H15a3.375 3.375 0 0 1 3.375 3.375v1.5" />
</svg>
 Copy Trading
            </a>
                        <a href="{{route('user.trading-history')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
 Trade History
            </a>

            

            
                        <p class="nav-group-label">Education</p>
            <a href="{{route('user.courses')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
</svg>
 Courses
            </a>
            <a href="{{route('user.my-courses')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
</svg>
 My Courses
            </a>
            
            
            <p class="nav-group-label">Account</p>
            <a href="{{route('user.profile')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
 Profile & Settings
            </a>
                        <a href="{{route('user.kyc')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
</svg>
 Verification
            </a>
                        <a href="{{route('user.referrals')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
</svg>
 Referral Program
            </a>
            <a href="{{route('user.news')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
</svg>
 Market News
            </a>
            <a href="{{route('user.support')}}" class="nav-link-item ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
</svg>

                <span class="flex-1">Support</span>
                
            </a>
        </nav>

        
        <div class="border-t border-surface-border p-4 shrink-0">
            <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form" class="hidden">
                @csrf
            </form>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();"
               class="nav-link-item !px-0 text-loss/80 hover:text-loss">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
</svg>
 Logout
            </a>
        </div>
    </aside>

    
    <header class="fixed top-0 right-0 z-30 h-16 bg-surface-raised border-b border-surface-border transition-all duration-200 lg:left-64 left-0">
        <div class="flex items-center justify-between h-full px-4 lg:px-6">
            
            <div class="flex items-center gap-3">
                <button @click="mobileSidebar = !mobileSidebar" class="lg:hidden text-content-tertiary hover:text-content-primary p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
</svg>
                </button>
                <h1 class="text-lg font-semibold text-content-primary hidden sm:block">Account Dashboard</h1>
            </div>

            
            <div class="flex items-center gap-2">
                
                <div class="relative"
                     x-data="{
                         notifs: [],
                         count: 0,
                         loaded: false,
                         loadNotifs() {
                             if (this.loaded) return;
                             fetch('{{route('user.notifications.unread')}}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                                 .then(r => r.json())
                                 .then(d => { this.notifs = d.notifications; this.count = d.count; this.loaded = true; });
                         },
                         markAllRead() {
                             fetch('{{route('user.notifications.read-all')}}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '4H60DyDUvWAS66zocDJnVrbaeRcvMv4w7PZgSi5d', 'X-Requested-With': 'XMLHttpRequest' } })
                                 .then(() => { this.notifs = []; this.count = 0; });
                         }
                     }"
                     @click.away="notifDropdown = false">
                    <button @click="notifDropdown = !notifDropdown; loadNotifs()" class="relative p-2 text-content-tertiary hover:text-content-primary rounded-lg hover:bg-surface-overlay transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
</svg>
                        <span x-show="count > 0" x-cloak class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] flex items-center justify-center bg-loss text-white text-[10px] font-bold rounded-full px-1" x-text="count > 99 ? '99+' : count"></span>
                    </button>
                    <div x-show="notifDropdown" x-cloak x-transition
                         class="absolute right-0 mt-2 w-80 bg-surface-raised border border-surface-border rounded-xl shadow-xl z-50 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-surface-border">
                            <h4 class="text-sm font-semibold text-content-primary">Notifications</h4>
                            <button x-show="count > 0" @click="markAllRead()" class="text-xs text-primary hover:text-primary-light transition-colors">Mark all read</button>
                        </div>
                        <div class="max-h-72 overflow-y-auto divide-y divide-surface-border">
                            <template x-if="notifs.length === 0">
                                <p class="text-sm text-content-tertiary text-center py-6">No new notifications</p>
                            </template>
                            <template x-for="n in notifs" :key="n.id">
                                <a :href="n.action_url || '#'" class="flex items-start gap-3 px-4 py-3 hover:bg-surface-overlay transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-primary-subtle flex items-center justify-center shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
</svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-content-primary truncate" x-text="n.title"></p>
                                        <p class="text-xs text-content-tertiary mt-0.5 line-clamp-2" x-text="n.message"></p>
                                        <p class="text-[10px] text-content-tertiary mt-1" x-text="n.time"></p>
                                    </div>
                                </a>
                            </template>
                        </div>
                        <a href="{{route('user.notifications')}}" class="block text-center text-xs text-primary hover:text-primary-light py-3 border-t border-surface-border transition-colors">View all notifications</a>
                    </div>
                </div>

                
                                                            @unless (Auth::user()->isKycApproved())
                            <a href="{{route('user.kyc')}}" class="hidden sm:inline-flex items-center gap-1 text-xs font-medium text-warning bg-warning/10 px-2.5 py-1 rounded-full hover:bg-warning/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
</svg>
 Verify KYC
                        </a>
                        @endunless
                                    
                
                <div class="relative" @click.away="userDropdown = false">
                    <button @click="userDropdown = !userDropdown" class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-surface-overlay transition-colors">
                                                    <img src="{{ Auth::user()->avatarUrl() }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover bg-surface-overlay">
                                                <span class="text-sm font-medium text-content-primary hidden md:block">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-tertiary hidden md:block" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
</svg>
                    </button>
                    <div x-show="userDropdown" x-cloak x-transition
                         class="absolute right-0 mt-2 w-48 bg-surface-raised border border-surface-border rounded-xl shadow-xl py-1 z-50">
                        <a href="{{route('user.profile')}}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
 Profile
                        </a>
                        <a href="{{route('user.deposit')}}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
 Deposit
                        </a>
                        <a href="{{route('user.withdrawal')}}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
</svg>
 Withdraw
                        </a>
                        <a href="{{route('user.transactions')}}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
</svg>
 Transactions
                        </a>
                        <div class="border-t border-surface-border my-1"></div>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm text-loss/80 hover:bg-surface-overlay hover:text-loss transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
</svg>
 Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

