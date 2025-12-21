<x-guest-layout>
    @section('title', 'Login')

    <div class="text-center mb-8">
        <h3 class="text-slate-900 text-2xl font-bold text-primary mb-6">Sign in to Admin Portal</h3>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Email
            </label>
            <input type="email" name="email"
                value="{{ old('email') }}"
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                autofocus required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Password
            </label>
            <div class="relative">
                <input type="password" name="password"
                    class="password-input w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900"
                    required>

                <button type="button"
                    onclick="togglePassword(this)"
                    class="absolute inset-y-0 right-3 flex items-center text-slate-500 hover:text-slate-700">
                    <i id="eyePasswordIcon" class="fa-regular fa-eye text-lg"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-5">
            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 transform hover:scale-[1.02] transition duration-200 flex items-center justify-center space-x-2">
                Sign In
            </button>
        </div>
    </form>

    <p class="text-center text-xs text-slate-400 mt-6">
        © {{ date('Y') }} Admin Panel
    </p>

    @push('scripts')
        <script>
            function togglePassword(button) {
                const wrapper = button.closest('.relative');
                const input = wrapper.querySelector('.password-input');
                const icon = button.querySelector('i');

                if (!input || !icon) return;

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    @endpush
</x-guest-layout>
