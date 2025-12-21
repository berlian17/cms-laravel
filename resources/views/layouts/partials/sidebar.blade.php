<aside id="sidebar" class="w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white flex-shrink-0 fixed lg:static inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto border-r border-slate-700/50">
    <div class="p-6 flex items-center justify-between border-b border-slate-700/50">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/CMS_LOGO.webp') }}" alt="logo" class="w-10 h-10">
            <div>
                <h1 class="text-lg font-bold text-white">Admin Panel</h1>
            </div>
        </div>

        <button id="sidebar-close" class="lg:hidden text-slate-400 hover:text-white transition-colors">
            <i class="fas fa-xmark text-xl"></i>
        </button>
    </div>

    <nav class="px-4 py-6 space-y-2">
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Main</p>
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fas fa-house text-lg"></i>
                <span class="font-medium">Dashboard</span>
            </a>
        </div>

        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Content</p>
            <a href="{{ route('medias.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('medias*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fas fa-newspaper text-lg"></i>
                <span class="font-medium">Media & Berita</span>
            </a>
            <a href="{{ route('services.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('services*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fas fa-cube text-lg"></i>
                <span class="font-medium">Layanan</span>
            </a>
            <a href="{{ route('projects.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('projects*') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fas fa-briefcase text-lg"></i>
                <span class="font-medium">Portofolio</span>
            </a>
        </div>

        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Kelola</p>
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('users.index') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fas fa-users text-lg"></i>
                <span class="font-medium">Users</span>
            </a>
            <a href="{{ route('settings.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('settings.edit') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fas fa-gear text-lg"></i>
                <span class="text-medium">Pengaturan</span>
            </a>
        </div>
    </nav>
</aside>
