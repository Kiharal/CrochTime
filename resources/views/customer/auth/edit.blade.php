<x-customer.guest-layout title="Verify your email">
    <h1 class="mb-2 text-xl font-semibold">Verify your email address</h1>
    <p class="mb-4 text-sm text-gray-600">
        We sent a verification link to <strong>{{ auth('customer')->user()->email }}</strong>.
        Open it to finish setting up your account. If it hasn't arrived, we can send another.
    </p>

    <div class="flex items-center justify-between">
        <form method="POST" action="{{ route('customer.verification.send') }}">
            @csrf
            <x-customer.button>Resend verification email</x-customer.button>
        </form>

        <div class="flex items-center gap-4 text-sm">
            <a href="{{ route('customer.profile.edit') }}" class="text-indigo-600 hover:underline">Change email</a>

            <form method="POST" action="{{ route('customer.logout') }}">
                @csrf
                <button type="submit" class="text-gray-600 underline hover:text-gray-900">Log out</button>
            </form>
        </div>
    </div>
</x-customer.guest-layout>
