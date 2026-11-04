<x-customer.guest-form method="POST" action="{{ route('customer.password.store') }}" title="Login" >
    <x-form_element errors="email">
        <x-form-input name="email" placeholder="Email" size="email" :value="old('email')" required autofocus autocomplete="username" />
    </x-form_element>

    <x-form_element errors="password">
        <x-form-input name="password" size="password" required autocomplete="new-password" />
    </x-form_element>

    <div class="flex items-center justify-between">
        <a href="{{ route('customer.register') }}" class="text-sm font-bold text-indigo-600  text-smokey-green hover:underline">No account? Sign up</a>
        <x-customer.guest-button>Login</x-customer.guest-button>
    </div>
</x-customer.guest-form>