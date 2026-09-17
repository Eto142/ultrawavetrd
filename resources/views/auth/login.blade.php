
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ultrawavetrd - Login account">
    <title>Login account | Ultrawavetrd</title>

    <!-- Favicon -->
    <link rel="icon" href="https://account.Ultrawavetrd.live/storage/app/public/photos/ZO47mJRZQWecg1WB4wWXp7hVtMvbRWiHdtXxGc4Q.png" sizes="any">

    <!-- Tailwind CSS (Play CDN) -->
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
                },
            },
        },
    }
    </script>
    <style type="text/tailwindcss">
    @layer  base {
        :root {
            --color-surface-base: #0D0F14;
            --color-surface-raised: #161A23;
            --color-surface-overlay: #1C2127;
            --color-surface-border: #2A2F36;
            --color-surface-border-light: #363C44;
            --color-content-primary: #EDEDED;
            --color-content-secondary: #A1A1AA;
            --color-content-tertiary: #6B7280;
        }
        html { background-color: #0D0F14; }
        body { font-family: 'Inter', system-ui, sans-serif; color: #A1A1AA; -webkit-font-smoothing: antialiased; }
        /* Custom select arrow for dark theme */
        select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; -webkit-appearance: none; -moz-appearance: none; appearance: none; padding-right: 2.5rem; }
    }
    </style>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    </head>
<body class="bg-surface-base min-h-screen flex flex-col">

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-8">
        
<div class="w-full max-w-md mx-auto">
    
    <div class="text-center mb-8">
        <a href="/">
            <img src="{{ asset('logo.png') }}" alt="Ultrawavetrd" class="h-12 mx-auto">
        </a>
    </div>

    
    <div class="bg-surface-raised border border-surface-border rounded-xl p-8">
        
        
        <h1 class="text-2xl font-bold text-content-primary mb-1">Sign In</h1>
        <p class="text-content-tertiary text-sm mb-6">Sign in to start trading crypto, forex and stocks.</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-loss/40 bg-loss/10 px-4 py-3 text-sm text-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{route('login.user')}}">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Email or Username</label>
                <input type="text" name="email" value="{{ old('email') }}" required
                    placeholder="Email or Username"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                            </div>

            
            <div class="mb-6">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Password</label>
                <input type="password" name="password" required
                    placeholder="Enter your password"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                            </div>

            
            <button type="submit"
                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                Sign In
            </button>
        </form>

        
        <div class="mt-6 space-y-2 text-sm">
            <p><a href="{{ url('forgot-password') }}" class="text-primary-light hover:text-primary transition-colors">Forgot password?</a></p>
            <p class="text-content-tertiary">Don't have an account? <a href="{{url('register')}}" class="text-primary-light hover:text-primary transition-colors">Register Here</a></p>
        </div>
    </div>
</div>

    </main>

    <!-- Language Selector -->
    <!--<div class="gtranslate_wrapper"></div>-->
<!--<script>-->
<!--    window.gtranslateSettings = {-->
<!--        default_language: "en",-->
<!--        alt_flags:{"en":"usa"},-->
<!--        wrapper_selector: ".gtranslate_wrapper",-->
<!--        flag_style: "3d",-->
<!--    };-->
<!--</script>-->
<!--<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>-->

    </body>
</html>

