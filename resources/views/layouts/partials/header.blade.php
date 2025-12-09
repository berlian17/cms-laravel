<header class="bg-white backdrop-blur-lg border-b border-slate-200 px-4 lg:px-6 py-4 sticky top-0 z-10 shadow-sm">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            {{-- Hamburger button mobile --}}
            <button id="sidebar-toggle" class="lg:hidden text-slate-600 hover:text-slate-900 focus:outline-none">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            
            <div>
                <h1 class="text-slate-900 text-xl lg:text-2xl font-bold">
                    {{ $pageTitle ?? 'Dashboard' }}
                </h1>
            </div>
        </div>

        <div class="flex items-center space-x-3 lg:space-x-4">
            {{-- Notifications --}}
            <button class="relative p-2 hover:bg-slate-200 rounded-lg transition-colors">
                <i class="fa-solid fa-bell text-slate-600 text-lg"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-blue-500 rounded-full animate-ping"></span>
            </button>

            {{-- Profile Dropdown --}}
            <div class="relative">
                <button id="profile-dropdown-btn" type="button" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <div class="h-9 lg:h-10 px-3 bg-blue-500 rounded-lg flex items-center justify-center text-white font-semibold text-sm shadow-lg">
                        <span class="sm:block">Admin</span>
                        <i class="fa-solid fa-chevron-down text-xs hidden sm:block ml-1"></i>
                    </div>
                </button>

                {{-- Dropdown Menu --}}
                <div id="profile-dropdown" class="hidden absolute right-0 mt-4 w-56 bg-white rounded-xl shadow-xl border border-slate-200 py-2 z-1000">
                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-50 text-slate-700 transition-colors">
                        <i class="fa-solid fa-user w-4 text-slate-400"></i>
                        <span class="text-sm">My Profile</span>
                    </a>
                    <hr class="my-2 border-slate-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 hover:bg-red-50 text-red-600 transition-colors text-left">
                            <i class="fa-solid fa-right-from-bracket w-4"></i>
                            <span class="text-sm font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
