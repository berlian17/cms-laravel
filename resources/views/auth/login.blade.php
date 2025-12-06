<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h3 class="text-slate-900 text-2xl font-bold text-primary mb-6">Sign in to Admin Portal</h3>

    <form action="{{ route('login') }}" class="space-y-6" method="POST">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                Email <span class="text-red-600">*</span>
            </label>
            <input
                id="email" type="email" name="email"
                class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                value="{{ old('email') }}" autofocus required
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                Password <span class="text-red-600">*</span>
            </label>
            <input
                id="password" type="password" name="password"
                class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none"
                required
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="bg-slate-800 text-white w-full rounded-lg font-semibold text-lg py-3 shadow-2xl hover:shadow-3xl hover:scale-105 flex items-center justify-center"
        >
            Sign in
        </button>
    </form>
</x-guest-layout>
