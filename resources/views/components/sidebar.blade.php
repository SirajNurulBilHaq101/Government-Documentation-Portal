{{-- Sidebar --}}
<div class="drawer-side z-50">

    <label for="sidebar-drawer" class="drawer-overlay bg-slate-900/40 backdrop-blur-sm"></label>

    <aside class="w-[280px] min-h-full bg-white border-r border-slate-200 flex flex-col shadow-sm">

        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div class="bg-blue-600 text-white p-2.5 rounded-xl shadow-sm shadow-blue-600/20">
                <i class="bi bi-shield-lock-fill text-lg leading-none"></i>
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight leading-none">
                    GovDocs
                </h2>
                <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase mt-1">Portal System</p>
            </div>
        </div>

        <div class="p-4 flex-1 overflow-y-auto">

            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 px-4">Menu</div>
            <ul class="menu text-slate-600 font-medium w-full gap-1 p-0">

                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-blue-50 text-blue-700 font-semibold border-r-4 border-blue-600' : 'hover:bg-slate-50 hover:text-slate-900 transition-colors' }} rounded-none py-3">
                        <i class="bi bi-grid-1x2-fill text-lg mr-2 {{ request()->is('/') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <details {{ request()->routeIs('documents.*') ? 'open' : '' }}>
                        <summary class="{{ request()->routeIs('documents.*') ? 'bg-slate-50 text-slate-800 font-semibold' : 'hover:bg-slate-50 hover:text-slate-900 transition-colors' }} rounded-none py-3">
                            <i class="bi bi-file-earmark-pdf text-lg mr-2 {{ request()->routeIs('documents.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                            Documents
                        </summary>
                        <ul class="mt-1 ml-4 border-l border-slate-200 pl-2">
                            <li>
                                <a href="{{ route('documents.index') }}" class="{{ request()->routeIs('documents.index') ? 'text-blue-700 font-semibold bg-transparent' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors' }} rounded-lg py-2.5">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('documents.index') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    All Documents
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('documents.create') }}" class="{{ request()->routeIs('documents.create') ? 'text-blue-700 font-semibold bg-transparent' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors' }} rounded-lg py-2.5">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('documents.create') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    Upload Document
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>

                <li>
                    <details {{ request()->routeIs('categories.*') ? 'open' : '' }}>
                        <summary class="{{ request()->routeIs('categories.*') ? 'bg-slate-50 text-slate-800 font-semibold' : 'hover:bg-slate-50 hover:text-slate-900 transition-colors' }} rounded-none py-3">
                            <i class="bi bi-tags text-lg mr-2 {{ request()->routeIs('categories.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                            Categories
                        </summary>
                        <ul class="mt-1 ml-4 border-l border-slate-200 pl-2">
                            <li>
                                <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'text-blue-700 font-semibold bg-transparent' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors' }} rounded-lg py-2.5">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('categories.index') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    All Categories
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categories.create') }}" class="{{ request()->routeIs('categories.create') ? 'text-blue-700 font-semibold bg-transparent' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors' }} rounded-lg py-2.5">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('categories.create') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    Create Category
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>

                <li>
                    <a href="{{ route('activities.index') }}" class="{{ request()->routeIs('activities.*') ? 'bg-blue-50 text-blue-700 font-semibold border-r-4 border-blue-600' : 'hover:bg-slate-50 hover:text-slate-900 transition-colors' }} rounded-none py-3">
                        <i class="bi bi-clock-history text-lg mr-2 {{ request()->routeIs('activities.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                        Activity Logs
                    </a>
                </li>

                <li>
                    <a href="#" class="hover:bg-slate-50 hover:text-slate-900 transition-colors rounded-none py-3 text-slate-500">
                        <i class="bi bi-people text-lg mr-2 text-slate-400"></i>
                        Users Management
                    </a>
                </li>

            </ul>

        </div>

        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
            <div class="bg-white rounded-xl p-4 text-center border border-slate-200 shadow-sm flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <div class="text-left">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">System Status</p>
                    <p class="text-xs font-bold text-slate-700">v1.0.4 - Optimal</p>
                </div>
            </div>
        </div>

    </aside>

</div>
