<x-customer.guest-form method="POST" action="{{ route('customer.login.store') }}" title="Login" >
    <x-form_element errors="email">
        <x-form-input name="email" placeholder="Email" size="email" :value="old('email')" required autofocus autocomplete="username" />
    </x-form_element>

    <x-form_element errors="password">
        <x-form-input name="password" size="password" required autocomplete="new-password" />
    </x-form_element>

    <div class="grid grid-cols-2 gap-x-4 align-items:center justify-items:center">
        <div class="grid grid-rows-2">
            <a href="{{ route('customer.register') }}" class="text-sm font-bold text-indigo-600  text-smokey-green hover:underline">No account? Sign up</a>
            @error('password')
                <a href="{{ route('customer.password.request') }}" class="text-sm font-bold text-indigo-600  text-smokey-green hover:underline">Forgot Password?</a>
    
            @enderror
        </div>
        <x-customer.guest-button>Login</x-customer.guest-button>
    </div>
</x-customer.guest-form>