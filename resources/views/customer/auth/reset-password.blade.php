<x-customer.guest-layout title="Confirm password">
    <h1 class="mb-2 text-xl font-semibold">Confirm your password</h1>
    <p class="mb-4 text-sm text-gray-600">
        This area is sensitive. Enter your password to continue.
    </p>

    <form method="POST" action="{{ route('customer.password.confirm') }}" class="space-y-4">
        @csrf

        <x-customer.input name="password" label="Password" type="password" required autofocus autocomplete="current-password" />

        <div class="flex justify-end">
            <x-customer.button>Confirm</x-customer.button>
        </div>
    </form>
</x-customer.guest-layout>
