
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ultrawavetrd - Verify your email">
    <title>Verify Your Email | Ultrawavetrd</title>

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
                        DEFAULT: '#EFB90B',
                        light: '#E6C76E',
                        dark: '#DFB41D',
                        subtle: 'rgba(239,185,11,0.12)',
                    },
                    gain: '#00C896',
                    loss: '#FF4D4F',
                    warning: '#F59E0B',
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
    }
    </style>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-surface-base min-h-screen flex flex-col">

    <main class="flex-1 flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-md mx-auto">

            <div class="text-center mb-8">
                <a href="/">
                    <img src="wp-content/uploads/2026/03/Asset-4651finvora-1024x127.png" alt="Ultrawavetrd" class="h-12 mx-auto">
                </a>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-8">

                <h1 class="text-2xl font-bold text-content-primary mb-1">Verify Your Email</h1>
                <p class="text-content-tertiary text-sm mb-6">
                    We've sent a 6-digit verification code to
                    @if($email)
                        <span class="text-content-secondary">{{ $email }}</span>.
                    @else
                        your email address.
                    @endif
                    Enter it below to activate your account.
                </p>

                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-gain/40 bg-gain/10 px-4 py-3 text-sm text-gain">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg border border-loss/40 bg-loss/10 px-4 py-3 text-sm text-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-loss/40 bg-loss/10 px-4 py-3 text-sm text-red-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('otp.verify.submit') }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-content-secondary mb-1.5">Verification Code</label>
                        <input type="text" name="otp" required inputmode="numeric" pattern="\d{6}" maxlength="6" autofocus
                            placeholder="Enter 6-digit code"
                            class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary text-center tracking-[0.5em] text-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    </div>

                    <button type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                        Verify Email
                    </button>
                </form>

                <form method="POST" action="{{ route('otp.verify.resend') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full text-sm text-primary-light hover:text-primary transition-colors">
                        Didn't receive a code? Resend
                    </button>
                </form>

                <div class="mt-6 text-sm text-content-tertiary text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-content-tertiary hover:text-content-secondary transition-colors">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>

</body>
</html>
