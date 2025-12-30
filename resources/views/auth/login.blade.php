<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex min-h-screen items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 rounded-2xl bg-white p-10 shadow-xl">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-slate-900">Welcome Back!</h2>
                <p class="mt-2 text-sm text-slate-600">Please sign in to your account</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :value="old('email')" autofocus>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-900">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot password?
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-lg transition-all hover:bg-indigo-700 hover:shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Sign In
                    </button>
                </div>
            </form>
            
            <p class="mt-4 text-center text-sm text-slate-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up</a>
            </p>
        </div>
    </div>
</x-guest-layout>
