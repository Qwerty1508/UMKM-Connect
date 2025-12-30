<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 rounded-2xl bg-white p-10 shadow-xl">
            <div class="text-center">
                <h2 class="mt-6 text-2xl font-bold text-slate-900">Forgot Password?</h2>
                <div class="mt-2 text-sm text-slate-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :value="old('email')" autofocus>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-lg transition-all hover:bg-indigo-700 hover:shadow-indigo-500/30">
                        {{ __('Email Password Reset Link') }}
                    </button>
                    
                    <div class="mt-4 text-center text-sm">
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Back to Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
