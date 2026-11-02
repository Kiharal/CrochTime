<x-layout title="Log in" nav="">
    <h1 class="mb-4 text-xl font-semibold">Verify email</h1>

    <form method="POST" action="{{ route('customer.login') }}" class="space-y-4">
        @csrf
        <x-form_element errors="email">
            <x-form-input placeholder="Email" name="email" label="Email" type="email" required autofocus autocomplete="username" ></x-form-input>
        </x-form_element>

        <x-form_element errors="password">

            <x-form-input placeholder="Password" name="password" label="Password" type="password" required autocomplete="current-password" ></x-form-input>
        </x-form_element>

        <label class="flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
            Keep me logged in
        </label>

        <div class="flex items-center justify-between">
            <a href="{{ route('customer.password.request') }}" class="text-sm text-indigo-600 hover:underline">
                Forgot your password?
            </a>
            <button
                type="submit"
                 class="z-10 text-s rounded-full bg-gray-50 px-3 py-1.5 font-medium m-5 text-gray-600 hover:bg-green-600 hover:text-white hover:cursor-pointer"
                 >
                 Log in</button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        New here?
        <a href="{{ route('customer.register') }}" class="text-indigo-600 hover:underline">Create an account</a>
    </p>
</x-layout>
