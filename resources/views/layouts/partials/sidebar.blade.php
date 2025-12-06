<aside id="sidebar" class="w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white flex-shrink-0 fixed lg:static inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto border-r border-slate-700/50">
    <div class="p-6 flex items-center justify-between border-b border-slate-700/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center shadow-lg">
                <i class="fa-solid fa-bolt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold text-white">CMS Dashboard</h1>
                <p class="text-xs text-slate-400">Admin Panel</p>
            </div>
        </div>
        <!-- Close button untuk mobile -->
        <button id="sidebar-close" class="lg:hidden text-slate-400 hover:text-white transition-colors">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    <nav class="px-4 py-6 space-y-2">
        <!-- MAIN Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Main</p>
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }} transition-all duration-200 group">
                <i class="fa-solid fa-house text-lg"></i>
                <span class="font-medium">Dashboard</span>
            </a>
        </div>

        <!-- CONTENT Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Content</p>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-file-lines text-lg"></i>
                <span class="font-medium">Halaman</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-newspaper text-lg"></i>
                <span class="font-medium">Blog/Artikel</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-cube text-lg"></i>
                <span class="font-medium">Produk/Layanan</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-briefcase text-lg"></i>
                <span class="font-medium">Portfolio</span>
            </a>
        </div>

        <!-- MEDIA Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Media</p>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-folder-open text-lg"></i>
                <span class="font-medium">Media Library</span>
            </a>
        </div>

        <!-- KELOLA Section -->
        <div class="mb-6">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Kelola</p>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-bars text-lg"></i>
                <span class="font-medium">Menu</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-envelope text-lg"></i>
                <span class="font-medium">Form Submissions</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800/50 hover:text-white transition-all duration-200 group">
                <i class="fa-solid fa-users text-lg"></i>
                <span class="font-medium">Users</span>
            </a>
        </div>
    </nav>
</aside>
