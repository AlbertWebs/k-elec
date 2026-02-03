<x-guest-layout>
    <div class="space-y-6">
        <!-- Page Title -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
            <p class="mt-2 text-sm text-gray-600">Sign in to your account to continue</p>
        </div>

        <!-- Session Status (Success Messages) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- General Error Alert -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-800">
                            {{ $errors->count() === 1 ? 'There was an error with your submission' : 'There were errors with your submission' }}
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input 
                    id="email" 
                    class="mt-2 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="Enter your email address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input 
                    id="password" 
                    class="mt-2 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:ring-2" 
                        name="remember">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                        {{ __('Remember me') }}
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a 
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition-colors duration-200" 
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                    {{ __('Sign In') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Additional Links -->
        @if (Route::has('register'))
            <div class="text-center text-sm text-gray-600">
                <span>Don't have an account? </span>
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition-colors duration-200">
                    {{ __('Sign up') }}
                </a>
            </div>
        @endif
    </div>
</x-guest-layout>
