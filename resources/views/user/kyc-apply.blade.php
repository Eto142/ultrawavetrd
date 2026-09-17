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

    <div class="mb-4">
        <a href="{{ route('user.kyc') }}" class="inline-flex items-center gap-1 text-sm text-content-tertiary hover:text-content-primary transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
            Back to Verification
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">KYC Application</h2>
        <p class="text-sm text-content-secondary mt-1">Submit your documents to verify your identity</p>
    </div>

    <div class="max-w-2xl mx-auto">

        @if ($submission && $submission->isRejected())
            <div class="rounded-xl bg-loss/10 border border-loss/20 p-5 mb-6">
                <h3 class="text-sm font-semibold text-loss mb-1">Your previous submission was rejected</h3>
                <p class="text-sm text-content-secondary">{{ $submission->rejection_reason ?: 'Please review your documents and submit again.' }}</p>
            </div>
        @endif

        <div class="rounded-xl bg-surface-raised border border-surface-border p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
</svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-content-primary">Verify Your Identity</h3>
                    <p class="text-sm text-content-tertiary">Required to comply with KYC/AML regulations.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('user.kyc.store') }}" enctype="multipart/form-data" class="space-y-5" x-data="{ documentType: 'passport' }">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Document Type</label>
                        <select name="document_type" x-model="documentType" required
                                class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                            @foreach (\App\Models\KycSubmission::DOCUMENT_TYPES as $value => $label)
                                <option value="{{ $value }}" {{ old('document_type') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('document_type')
                            <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Document Number</label>
                        <input type="text" name="document_number" value="{{ old('document_number') }}" required
                               class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                        @error('document_number')
                            <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                               class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                        @error('date_of_birth')
                            <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Country</label>
                        <input type="text" name="country" value="{{ old('country', $user->country) }}" required
                               class="w-full bg-surface-overlay border border-surface-border-light rounded-lg px-4 py-3 text-sm text-content-primary focus:outline-none focus:border-primary transition">
                        @error('country')
                            <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5" x-text="documentType === 'passport' ? 'Passport Photo Page' : 'Front of Document'"></label>
                        <input type="file" name="front_document" accept="image/*" required
                               class="block w-full text-sm text-content-secondary file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">
                        @error('front_document')
                            <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-show="documentType !== 'passport'" x-cloak>
                        <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Back of Document</label>
                        <input type="file" name="back_document" accept="image/*"
                               class="block w-full text-sm text-content-secondary file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">
                        @error('back_document')
                            <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-content-tertiary uppercase tracking-wide mb-1.5">Selfie Holding Your Document</label>
                    <input type="file" name="selfie" accept="image/*" required
                           class="block w-full text-sm text-content-secondary file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">
                    <p class="mt-1 text-xs text-content-tertiary">A clear photo of you holding the document next to your face.</p>
                    @error('selfie')
                        <p class="mt-1 text-xs text-loss">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-primary text-content-inverse font-semibold hover:bg-primary-dark transition">
                        Submit for Verification
                    </button>
                </div>
            </form>
        </div>

    </div>

        </div>


        <footer class="border-t border-surface-border py-6 px-6 mt-8">
            <p class="text-sm text-content-tertiary text-center">
                &copy; Ultrawavetrd.
            </p>
        </footer>
    </main>
