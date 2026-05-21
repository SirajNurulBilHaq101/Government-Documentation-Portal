{{-- Header --}}
<header class="navbar bg-white border-b border-slate-200 px-4 md:px-6 lg:px-8 py-2.5 shadow-sm sticky top-0 z-40">

    <div class="flex-none lg:hidden">
        <label for="sidebar-drawer" class="btn btn-square btn-ghost text-slate-600 hover:bg-slate-100">
            <i class="bi bi-list text-2xl"></i>
        </label>
    </div>

    <div class="flex-1"></div>

    <div class="flex-none gap-2">
        <div class="dropdown dropdown-end">

            <div tabindex="0" role="button" class="btn btn-ghost hover:bg-slate-50 flex items-center gap-3 px-3 rounded-xl border border-transparent hover:border-slate-200 transition-all">
                <div class="avatar placeholder">
                    <div class="bg-blue-600 text-white rounded-lg w-8 shadow-sm">
                        <span class="text-xs font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                    </div>
                </div>
                <div class="text-left hidden sm:block">
                    <div class="font-bold text-sm text-slate-800 leading-none">{{ Auth::user()->name ?? 'Admin User' }}</div>
                    <div class="text-[11px] text-slate-500 font-medium mt-1 leading-none">{{ Auth::user()->email ?? 'admin@gov.id' }}</div>
                </div>
                <i class="bi bi-chevron-down text-[10px] text-slate-400 ml-1"></i>
            </div>

            <ul tabindex="0"
                class="dropdown-content menu bg-white rounded-xl w-56 p-2 shadow-lg border border-slate-200 mt-4">

                <li class="menu-title px-4 py-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Account</li>
                <li>
                    <a href="#" class="text-slate-700 hover:bg-slate-50 hover:text-blue-600 rounded-lg py-2.5 font-medium transition-colors">
                        <i class="bi bi-person text-lg mr-2 opacity-70"></i>
                        Profile Settings
                    </a>
                </li>
                <li class="my-1 border-t border-slate-100"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="p-0">
                        @csrf
                        <button class="w-full text-left text-red-600 hover:bg-red-50 rounded-lg py-2.5 px-4 font-medium transition-colors flex items-center">
                            <i class="bi bi-box-arrow-right text-lg mr-3 opacity-80"></i>
                            Sign Out
                        </button>
                    </form>
                </li>
            </ul>

        </div>
    </div>

</header>
