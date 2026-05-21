{{-- Sidebar --}}
<div class="drawer-side z-50">

    <label for="sidebar-drawer" class="drawer-overlay"></label>

    <aside class="w-72 min-h-full bg-base-100 border-r border-base-300 shadow-sm flex flex-col">

        <div class="p-6 border-b border-base-200 flex items-center gap-3">
            <div class="bg-neutral text-neutral-content p-2 rounded-lg shadow-sm">
                <i class="bi bi-shield-lock-fill text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-neutral tracking-tight">
                GovDocs
            </h2>
        </div>

        <div class="p-4 flex-1">

            <ul class="menu text-neutral font-medium w-full gap-2">

                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active bg-neutral text-neutral-content shadow-sm' : 'hover:bg-base-200 transition-colors' }}">
                        <i class="bi bi-grid-1x2-fill text-lg mr-2 {{ request()->is('/') ? '' : 'text-neutral/70' }}"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('documents.index') }}" class="{{ request()->routeIs('documents.*') ? 'active bg-neutral text-neutral-content shadow-sm' : 'hover:bg-base-200 transition-colors' }}">
                        <i class="bi bi-file-earmark-pdf text-lg mr-2 {{ request()->routeIs('documents.*') ? '' : 'text-neutral/70' }}"></i>
                        Documents
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active bg-neutral text-neutral-content shadow-sm' : 'hover:bg-base-200 transition-colors' }}">
                        <i class="bi bi-tags text-lg mr-2 {{ request()->routeIs('categories.*') ? '' : 'text-neutral/70' }}"></i>
                        Categories
                    </a>
                </li>

                <li>
                    <a href="{{ route('activities.index') }}" class="{{ request()->routeIs('activities.*') ? 'active bg-neutral text-neutral-content shadow-sm' : 'hover:bg-base-200 transition-colors' }}">
                        <i class="bi bi-clock-history text-lg mr-2 {{ request()->routeIs('activities.*') ? '' : 'text-neutral/70' }}"></i>
                        Activity Logs
                    </a>
                </li>

                <li>
                    <a href="#" class="hover:bg-base-200 transition-colors">
                        <i class="bi bi-people text-lg mr-2 text-neutral/70"></i>
                        Users
                    </a>
                </li>

            </ul>

        </div>

        <div class="p-4 border-t border-base-200">
            <div class="bg-base-200 rounded-xl p-4 text-center border border-base-300">
                <p class="text-xs text-neutral/70 font-medium mb-2">System Version</p>
                <p class="text-sm font-bold text-neutral">v1.0.4 - Pro</p>
            </div>
        </div>

    </aside>

</div>
