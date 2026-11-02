<x-customer.guest-layout title="Create account">
    <h1 class="mb-4 text-xl font-semibold">Create your account</h1>

    <form method="POST" action="{{ route('customer.register') }}" class="space-y-4">
        @csrf

        <x-customer.input name="name" label="Name" required autofocus autocomplete="name" />
        <x-customer.input name="email" label="Email" type="email" required autocomplete="username" />
        <x-customer.input name="password" label="Password" type="password" required autocomplete="new-password" />
        <x-customer.input name="password_confirmation" label="Confirm password" type="password" required autocomplete="new-password" />

        <div class="flex items-center justify-between">
            <a href="{{ route('customer.login') }}" class="text-sm text-indigo-600 hover:underline">
                Already have an account?
            </a>
            <x-customer.button>Create account</x-customer.button>
        </div>
    </form>
</x-customer.guest-layout>
