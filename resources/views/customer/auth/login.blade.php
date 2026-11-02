<x-customer.guest-layout title="Choose a new password">
    <h1 class="mb-4 text-xl font-semibold">Choose a new password</h1>

    <form method="POST" action="{{ route('customer.password.store') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-customer.input name="email" label="Email" type="email" :value="$request->email" required autofocus autocomplete="username" />
        <x-customer.input name="password" label="New password" type="password" required autocomplete="new-password" />
        <x-customer.input name="password_confirmation" label="Confirm new password" type="password" required autocomplete="new-password" />

        <div class="flex justify-end">
            <x-customer.button>Save new password</x-customer.button>
        </div>
    </form>
</x-customer.guest-layout>
