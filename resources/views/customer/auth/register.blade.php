<x-customer.guest-form method="POST" action="{{ route('customer.register.store') }}" title="Login">
    <x-form_element errors="first_name">
        <x-form-label for="first_name">First Name</x-form-label>
        <x-form-input name="first_name" :value="old('first_name')" size="input" required autofocus></x-form-input>
    </x-form_element>

    <x-form_element errors="last_name">
        <x-form-label for="last_name">Last Name</x-form-label>
        <x-form-input name="last_name" :value="old('last_name')" size="input" required autofocus></x-form-input>
    </x-form_element>

    <x-form_element errors="email">
        <x-form-label for="email">Email</x-form-label>
        <x-form-input name="email" :value="old('email')" size="email" required autofocus></x-form-input>
    </x-form_element>

    <x-form_element errors="phone">
        <x-form-label for="phone">Phone Number</x-form-label>
        <x-form-input name="phone" :value="old('phone')" size="tel" required autofocus></x-form-input>
    </x-form_element>

    <x-form_element errors="instagram">
        <x-form-label for="instagram">Instagram</x-form-label>
        <x-form-input name="instagram" :value="old('instagram')" size="input" required autofocus></x-form-input>
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
        <a href="{{ route('customer.login') }}" class="text-sm text-indigo-600 hover:underline">Back to log in</a>
        <button
        type="submit"
            class="z-10 text-s rounded-full bg-gray-50 px-3 py-1.5 font-medium m-5 text-gray-600 hover:bg-green-600 hover:text-white hover:cursor-pointer"
            >
            Send reset link</button>
    </div>
</x-customer.guest-form>