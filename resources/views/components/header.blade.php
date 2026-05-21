{{-- Header --}}
<header class="navbar bg-base-100 border-b border-base-300 px-6 py-2 shadow-sm">

    <div class="flex-none lg:hidden">
        <label for="sidebar-drawer" class="btn btn-square btn-ghost">
            <i class="bi bi-list text-2xl"></i>
        </label>
    </div>

    <div class="flex-1">
    </div>

    <div class="flex-none gap-2">
        <div class="dropdown dropdown-end">

            <div tabindex="0" role="button" class="btn btn-ghost flex items-center gap-2 px-2">
                <div class="avatar placeholder">
                    <div class="bg-neutral text-neutral-content rounded-full w-8">
                        <span class="text-xs font-bold">AD</span>
                    </div>
                </div>
                <span class="font-medium text-neutral hidden sm:block">Admin User</span>
                <i class="bi bi-chevron-down text-xs text-neutral/70"></i>
            </div>

            <ul tabindex="0"
                class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow-lg border border-base-200 mt-3">

                <li>
                    <a href="#" class="text-neutral hover:bg-base-200">
                        <i class="bi bi-person text-lg mr-2"></i>
                        Profile
                    </a>
                </li>
                <li class="my-1 border-t border-base-200"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">

                        @csrf
                    
                        <button class="text-error hover:bg-error/10 hover:text-error">
                            <i class="bi bi-box-arrow-right text-lg mr-2"></i>
                            Logout
                        </button>
                    
                    </form>
                </li>

            </ul>

        </div>
    </div>

</header>
