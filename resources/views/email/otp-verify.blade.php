<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('otp-verify') }}">
        @csrf
        <input type="hidden" value="{{$user->phone}}" name="mobile">
        <!-- Email Address -->
        <div>
            <!-- OTP Input -->
            <x-input-label for="otp" :value="__('OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp"  required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <!-- New Password Input -->
            <x-input-label for="new_password" :value="__('New Password')" />
            <x-text-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required />
            <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <!-- Confirm Password Input -->
            <x-input-label for="confirm_password" :value="__('Confirm Password')" />
            <x-text-input id="confirm_password" class="block mt-1 w-full" type="password" name="confirm_password" required />
            <x-input-error :messages="$errors->get('confirm_password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
