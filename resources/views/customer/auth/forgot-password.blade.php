<x-customer.guest-form method="POST" action="{{ route('customer.password.email') }}" title="Reset Password" >
    <x-form_element errors="email">
        <x-form-input name="email" placeholder="Email" size="email" :value="old('email')" required autofocus autocomplete="username" />
    </x-form_element>

    <div class="grid grid-cols-2 gap-x-4 align-items:center justify-items:center">
        
        <a href="{{ route('customer.login') }}" class="inline-block p-6 pt-10 text-sm font-bold text-indigo-600  text-smokey-green hover:underline">Return to login</a>
        
        <x-customer.guest-button>Send link to Email</x-customer.guest-button>
    </div>
</x-customer.guest-form>