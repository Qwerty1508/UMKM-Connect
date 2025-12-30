<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 rounded-2xl bg-white p-10 shadow-xl">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-slate-900">Create Account</h2>
                <p class="mt-2 text-sm text-slate-600">Join UMKM Connect today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" autocomplete="name" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :value="old('name')" autofocus>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :value="old('email')">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                
                <!-- Role Selection -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">I want to join as:</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="user" class="peer sr-only" checked>
                            <div class="rounded-xl border-2 border-slate-200 p-4 text-center transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50 hover:border-indigo-200">
                                <span class="block font-bold text-slate-700 peer-checked:text-indigo-700">Buyer</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="seller" class="peer sr-only">
                            <div class="rounded-xl border-2 border-slate-200 p-4 text-center transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50 hover:border-indigo-200">
                                <span class="block font-bold text-slate-700 peer-checked:text-indigo-700">Seller (UMKM)</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="block w-full rounded-lg border-slate-200 px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-lg transition-all hover:bg-indigo-700 hover:shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Create Account
                    </button>
                </div>
            </form>
            
            <p class="mt-4 text-center text-sm text-slate-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>
</x-guest-layout>
