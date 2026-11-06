<x-customer.guest-form method="POST" action="{{ route('customer.password.store') }}" title="Reset Password">
    <x-form_element errors="email">
        <x-form-label for="email">Email</x-form-label>
        <x-form-input name="email" :value="old('email')" size="email" required autofocus></x-form-input>
    </x-form_element>

    
    <x-form_element errors="password">
        <x-form-label for="password">Password</x-form-label>
        <x-form-input name="password" :value="old('password')" size="password" required></x-form-input>
    </x-form_element>

        <x-form_element errors="password_confirmation">
        <x-form-label for="password_confirmation">Confirm Password</x-form-label>
        <x-form-input name="password_confirmation" :value="old('password')" size="password" required></x-form-input>
    </x-form_element>


    <div class="flex items-center justify-between">
        <button
        type="submit"
            class="z-10 text-s rounded-full bg-gray-50 px-3 py-1.5 font-medium m-5 text-gray-600 hover:bg-green-600 hover:text-white hover:cursor-pointer"
            >
            Continue</button>
    </div>
</x-customer.guest-form>