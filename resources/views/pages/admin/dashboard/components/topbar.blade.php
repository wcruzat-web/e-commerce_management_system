{{--
    ERP MODULE: Admin Dashboard
    COMPONENT: Topbar
    DESCRIPTION: Top bar with ERP sync status, notifications, and user info.
    TODO: Replace with $erpSyncStatus, Auth::user()->name/role, $notifications
--}}

<div class="bg-white border-b border-gray-200 px-4 lg:px-6 py-3 flex items-center justify-between relative">
    {{-- Mobile hamburger --}}
    <button type="button" class="lg:hidden mr-3 text-gray-500 hover:text-gray-700" onclick="toggleMobileSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>
    <div class="flex items-center gap-2 text-sm text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-cyan-500 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="23 4 23 10 17 10"></polyline>
            <polyline points="1 20 1 14 7 14"></polyline>
            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
        </svg>
        ERP Sync Active
        <span class="w-2 h-2 rounded-full bg-green-500"></span>
    </div>

    <div class="flex items-center gap-3 lg:gap-5">
        {{-- Notification bell --}}
        <div class="relative">
            <button type="button" onclick="toggleNotifications()" aria-label="Notifications" class="relative text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-red-500"></span>
            </button>

            {{-- NOTIFICATIONS DROPDOWN --}}
            <div id="notificationsDropdown" class="hidden absolute right-0 top-full mt-3 w-80 bg-white border border-gray-200 rounded-xl shadow-xl z-50">
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-900">Notifications</p>
                    <span class="text-[11px] font-medium bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">1 new</span>
                </div>
                <div class="px-4 py-3">
                    <div class="flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500 mt-0.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <div class="flex-1">
                            <p class="text-xs text-gray-700">Low stock: RTX 4090 (2 units left)</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">2m ago</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 px-4 py-2.5">
                    <a href="#" class="text-xs font-medium text-cyan-500 hover:text-cyan-600">View all notifications</a>
                </div>
            </div>
        </div>

        {{-- User --}}
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-gray-200"></div>
            <div class="leading-tight">
                <p class="text-xs font-semibold text-gray-900">John Doe</p>
                <p class="text-[11px] text-gray-400">Super Admin</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleNotifications() {
        document.getElementById('notificationsDropdown').classList.toggle('hidden');
    }

    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('notificationsDropdown');
        const isBellClick = event.target.closest('button[onclick="toggleNotifications()"]');
        if (!dropdown.contains(event.target) && !isBellClick) {
            dropdown.classList.add('hidden');
        }
    });
</script>
