{{-- Sidebar --}}
<div class="drawer-side z-50">

    <label for="sidebar-drawer" class="drawer-overlay bg-slate-900/40 backdrop-blur-sm"></label>

    <aside class="w-[280px] min-h-full bg-white border-r border-slate-200 flex flex-col shadow-sm">

        {{-- Logo --}}
        <div class="p-6 border-b border-slate-100 flex items-center gap-3">
            <div class="bg-blue-600 text-white p-2.5 rounded-xl shadow-sm shadow-blue-600/20">
                <i class="bi bi-shield-lock-fill text-lg leading-none"></i>
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight leading-none">GovDocs</h2>
                <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase mt-1">Portal System</p>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="p-4 flex-1 overflow-y-auto">

            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 px-2">Menu</div>
            <ul class="menu text-slate-600 font-medium w-full gap-0.5 p-0">

                {{-- Dashboard — semua role --}}
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-blue-50 text-blue-700 font-semibold border-r-4 border-blue-600' : 'hover:bg-slate-50 hover:text-slate-900' }} rounded-none py-3 transition-colors">
                        <i class="bi bi-grid-1x2-fill text-base mr-2 {{ request()->is('/') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                        Dashboard
                    </a>
                </li>

                {{-- Documents — semua role --}}
                <li>
                    <details {{ request()->routeIs('documents.*') ? 'open' : '' }}>
                        <summary class="{{ request()->routeIs('documents.*') ? 'bg-slate-50 text-slate-800 font-semibold' : 'hover:bg-slate-50 hover:text-slate-900' }} rounded-none py-3 transition-colors">
                            <i class="bi bi-file-earmark-pdf text-base mr-2 {{ request()->routeIs('documents.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                            Documents
                        </summary>
                        <ul class="mt-1 ml-4 border-l border-slate-200 pl-2">
                            <li>
                                <a href="{{ route('documents.index') }}" class="{{ request()->routeIs('documents.index') ? 'text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }} rounded-lg py-2.5 transition-colors">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('documents.index') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    All Documents
                                </a>
                            </li>
                            @if(auth()->user()->canManage())
                            <li>
                                <a href="{{ route('documents.create') }}" class="{{ request()->routeIs('documents.create') ? 'text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }} rounded-lg py-2.5 transition-colors">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('documents.create') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    Upload Document
                                </a>
                            </li>
                            @endif
                        </ul>
                    </details>
                </li>

                {{-- Categories — admin & staff (viewer hanya bisa lihat jika ada link dari dokumen) --}}
                @if(auth()->user()->canManage())
                <li>
                    <details {{ request()->routeIs('categories.*') ? 'open' : '' }}>
                        <summary class="{{ request()->routeIs('categories.*') ? 'bg-slate-50 text-slate-800 font-semibold' : 'hover:bg-slate-50 hover:text-slate-900' }} rounded-none py-3 transition-colors">
                            <i class="bi bi-tags text-base mr-2 {{ request()->routeIs('categories.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                            Categories
                        </summary>
                        <ul class="mt-1 ml-4 border-l border-slate-200 pl-2">
                            <li>
                                <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }} rounded-lg py-2.5 transition-colors">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('categories.index') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    All Categories
                                </a>
                            </li>
                            @if(auth()->user()->isAdmin())
                            <li>
                                <a href="{{ route('categories.create') }}" class="{{ request()->routeIs('categories.create') ? 'text-blue-700 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }} rounded-lg py-2.5 transition-colors">
                                    <i class="bi bi-dot mr-1 {{ request()->routeIs('categories.create') ? 'text-blue-600 text-xl' : 'text-slate-300 text-lg' }}"></i>
                                    Create Category
                                </a>
                            </li>
                            @endif
                        </ul>
                    </details>
                </li>
                @endif

                {{-- Activity Logs — admin only --}}
                @if(auth()->user()->isAdmin())
                <li>
                    <a href="{{ route('activities.index') }}" class="{{ request()->routeIs('activities.*') ? 'bg-blue-50 text-blue-700 font-semibold border-r-4 border-blue-600' : 'hover:bg-slate-50 hover:text-slate-900' }} rounded-none py-3 transition-colors">
                        <i class="bi bi-clock-history text-base mr-2 {{ request()->routeIs('activities.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                        Activity Logs
                    </a>
                </li>
                @endif

                {{-- User Management — admin only --}}
                @if(auth()->user()->isAdmin())
                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700 font-semibold border-r-4 border-blue-600' : 'hover:bg-slate-50 hover:text-slate-900' }} rounded-none py-3 transition-colors">
                        <i class="bi bi-people-fill text-base mr-2 {{ request()->routeIs('users.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                        Users
                    </a>
                </li>
                @endif

            </ul>

        </div>

        {{-- User Info + Status --}}
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 space-y-3">

            {{-- Role Badge --}}
            <div class="flex items-center justify-between px-1">
                <div class="flex items-center gap-2">
                    <div class="avatar placeholder">
                        <div class="bg-blue-600 text-white rounded-lg w-8">
                            <span class="text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-700 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 mt-0.5 leading-none">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
                @php
                    $roleColor = match(auth()->user()->role) {
                        'admin'  => 'bg-rose-50 text-rose-600 border-rose-200',
                        'staff'  => 'bg-blue-50 text-blue-600 border-blue-200',
                        'viewer' => 'bg-slate-100 text-slate-600 border-slate-200',
                        default  => 'bg-slate-100 text-slate-600 border-slate-200',
                    };
                @endphp
                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded border {{ $roleColor }}">
                    {{ auth()->user()->role }}
                </span>
            </div>

            {{-- System Status --}}
            <div class="bg-white rounded-xl p-3 border border-slate-200 shadow-sm flex items-center gap-2.5">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shrink-0"></div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider leading-none mb-0.5">System Status</p>
                    <p class="text-xs font-bold text-slate-700 leading-none">v1.0.4 — Optimal</p>
                </div>
            </div>
        </div>

    </aside>

</div>
