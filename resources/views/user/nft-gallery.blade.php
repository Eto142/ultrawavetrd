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

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl font-bold text-content-primary">NFT Marketplace</h2>
            <p class="text-sm text-content-secondary mt-1">Discover, collect, and trade unique digital assets</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('user.mint-nft') }}" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Mint NFT
            </a>
            <a href="{{ route('user.my-collection') }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">My NFTs</a>
        </div>
    </div>

    @if ($featured->isNotEmpty())
        <div class="mb-6">
            <h3 class="text-sm font-semibold text-content-primary mb-3 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-warning" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
</svg>
 Featured
            </h3>
            <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-thin">
                @foreach ($featured as $item)
                    <a href="{{ route('user.nfts.show', $item) }}" class="flex-shrink-0 w-56 rounded-xl bg-surface-raised border border-surface-border overflow-hidden hover:border-primary/50 transition-colors group">
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-3">
                            <p class="text-sm font-medium text-content-primary truncate">{{ $item->name }}</p>
                            <p class="text-xs text-primary font-semibold">{{ number_format($item->price, 8) }} ETH</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="mb-6">
        <h3 class="text-sm font-semibold text-content-primary mb-3 flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-tertiary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
</svg>
 Collections
        </h3>
        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-thin">
            @foreach ($collections as $collection)
                <a href="{{ route('user.nft-gallery', ['collection_id' => $collection->id]) }}" class="flex-shrink-0 px-4 py-2.5 rounded-xl bg-surface-raised border {{ (int) request('collection_id') === $collection->id ? 'border-primary' : 'border-surface-border' }} hover:border-primary/50 transition-colors text-center min-w-[120px]">
                    <p class="text-sm font-medium text-content-primary truncate">{{ $collection->name }}</p>
                    <p class="text-xs text-content-tertiary">{{ $collection->nfts_count }} items</p>
                </a>
            @endforeach
        </div>
    </div>

    <div class="rounded-xl bg-surface-raised border border-surface-border p-4 mb-6" x-data="{ showFilters: {{ request()->hasAny(['min_price', 'max_price']) ? 'true' : 'false' }} }">
        <form method="GET" action="{{ route('user.nft-gallery') }}">
            <div class="flex flex-wrap items-center gap-2 mb-3">

                <a href="{{ route('user.nft-gallery') }}" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ request('category_id') ? 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' : 'bg-primary text-content-inverse' }}">All</a>
                @foreach (\App\Models\Nft::CATEGORIES as $key => $label)
                    <a href="{{ route('user.nft-gallery', ['category_id' => $key]) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ request('category_id') === $key ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">{{ $label }}</a>
                @endforeach

                <button type="button" @click="showFilters = !showFilters" class="ml-auto px-3 py-1.5 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-xs font-medium transition-colors inline-flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
</svg>
 Filters
                </button>
            </div>

            <div class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or description..."
                       class="flex-1 px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary">
                <button type="submit" class="px-4 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Search</button>
            </div>

            <div x-show="showFilters" x-transition x-cloak class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3 pt-3 border-t border-surface-border">
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Min Price (ETH)</label>
                    <input type="number" name="min_price" step="0.00000001" value="{{ request('min_price') }}" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="0">
                </div>
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Max Price (ETH)</label>
                    <input type="number" name="max_price" step="0.00000001" value="{{ request('max_price') }}" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="100">
                </div>
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Collection</label>
                    <select name="collection_id" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All</option>
                        @foreach ($collections as $collection)
                            <option value="{{ $collection->id }}" @selected((int) request('collection_id') === $collection->id)>{{ $collection->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Sort By</label>
                    <select name="sort" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low → High</option>
                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High → Low</option>
                        <option value="popular" @selected(request('sort') === 'popular')>Most Viewed</option>
                        <option value="liked" @selected(request('sort') === 'liked')>Most Liked</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse ($nfts as $nft)
            <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden hover:border-primary/50 transition-colors group">
                <a href="{{ route('user.nfts.show', $nft) }}" class="block relative">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ asset('storage/' . $nft->image_path) }}" alt="{{ $nft->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>
                    @if ($nft->is_featured)
                        <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-warning/90 text-surface-base text-[10px] font-bold">Featured</span>
                    @endif
                </a>
                <div class="p-4">
                    <div class="flex items-start justify-between mb-1">
                        <h4 class="text-sm font-semibold text-content-primary truncate flex-1">{{ $nft->name }}</h4>
                        <form action="{{ route('user.nfts.like', $nft) }}" method="POST" class="ml-2 flex-shrink-0">
                            @csrf
                            <button type="submit" class="{{ $nft->isLikedBy(Auth::user()) ? 'text-loss' : 'text-content-tertiary hover:text-loss' }} transition-colors" title="Like">
                                <svg class="w-4 h-4" fill="{{ $nft->isLikedBy(Auth::user()) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                            </button>
                        </form>
                    </div>
                    @if ($nft->collection)
                        <p class="text-[10px] text-content-tertiary mb-1">{{ $nft->collection->name }}</p>
                    @endif
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-primary">{{ number_format($nft->price, 8) }} ETH</span>
                        <span class="text-[10px] text-content-tertiary flex items-center gap-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
 {{ $nft->views_count }}
                        </span>
                    </div>
                    <a href="{{ route('user.nfts.show', $nft) }}" class="w-full block text-center py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">View</a>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-xl bg-surface-raised border border-surface-border p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>
                <p class="text-content-secondary mb-1">No NFTs found</p>
                <p class="text-xs text-content-tertiary mb-3">Be the first to mint one, or try different filters</p>
                <a href="{{ route('user.mint-nft') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">
                    Mint NFT
                </a>
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
