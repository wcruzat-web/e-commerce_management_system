{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Sidebar
    DESCRIPTION: Navigation sidebar with brand, nav links, and sign out.
    TODO: Replace with Auth::user()->business_name, wire nav links to routes
--}}

<aside class="w-60 shrink-0 bg-blue-900 flex flex-col justify-between">
    <div>
        <div class="flex items-center gap-3 px-5 py-6 border-b border-white/10">
            <div class="w-9 h-9 rounded-full bg-gray-200 shrink-0"></div>
            <p class="text-sm text-white leading-tight">
                <span class="font-semibold">BusinessName's</span>
                <span class="text-cyan-300 font-semibold">Admin</span>
            </p>
        </div>

        <nav class="px-3 py-5 space-y-1">
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-white/10 text-white text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                    <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                    <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                    <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-200 hover:bg-white/10 hover:text-white text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 7L12 3 4 7v10l8 4 8-4V7z"></path>
                    <path d="M4 7l8 4 8-4"></path>
                    <line x1="12" y1="11" x2="12" y2="21"></line>
                </svg>
                Product
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-200 hover:bg-white/10 hover:text-white text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"></path>
                    <rect x="9" y="3" width="6" height="4" rx="1"></rect>
                </svg>
                Inventory
            </a>
        </nav>
    </div>

    <div class="px-3 py-5 border-t border-white/10">
        <a href="#" onclick="event.preventDefault(); signOut();" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-blue-200 hover:bg-white/10 hover:text-white text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Sign Out
        </a>
    </div>
</aside>
