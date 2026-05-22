<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Users'],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Users Management</h1>
            <p class="text-sm text-slate-500 mt-1">Manage system accounts and access roles</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 px-5 rounded-lg font-medium">
            <i class="bi bi-person-plus mr-1"></i> New User
        </a>
    </div>

    @if(session('success'))
        <div class="alert shadow-sm mb-5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl flex items-center gap-2">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="alert shadow-sm mb-5 bg-rose-50 text-rose-700 border border-rose-200 rounded-xl flex items-center gap-2">
            <i class="bi bi-exclamation-circle-fill text-rose-500"></i>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Filter Bar --}}
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-3 justify-between items-center">
            <form action="{{ route('users.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 w-full sm:max-w-lg">
                <div class="relative flex-1">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, NIP..."
                        class="input input-sm h-10 input-bordered w-full pl-10 bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm" />
                </div>
                <div class="flex gap-2">
                    <select name="role" class="select select-sm h-10 select-bordered w-36 bg-slate-50 border-slate-200 focus:border-blue-500 transition-all rounded-lg text-sm font-medium text-slate-600">
                        <option value="">All Roles</option>
                        <option value="admin"  {{ request('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                        <option value="staff"  {{ request('role') === 'staff'  ? 'selected' : '' }}>Staff</option>
                        <option value="viewer" {{ request('role') === 'viewer' ? 'selected' : '' }}>Viewer</option>
                    </select>
                    <button type="submit" class="btn btn-sm h-10 bg-blue-600 hover:bg-blue-700 text-white border-none rounded-lg px-4 shadow-sm">
                        <i class="bi bi-funnel mr-1"></i> Filter
                    </button>
                    @if(request('search') || request('role'))
                    <a href="{{ route('users.index') }}" class="btn btn-sm h-10 bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200 rounded-lg px-3">
                        <i class="bi bi-x-lg"></i>
                    </a>
                    @endif
                </div>
            </form>
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-widest hidden sm:block shrink-0">
                {{ $users->total() }} Users
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="table w-full text-sm">
                <thead>
                    <tr class="text-slate-400 border-b border-slate-200 text-xs uppercase tracking-wider bg-slate-50/50">
                        <th class="font-semibold px-5 py-3.5 rounded-none">User</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none hidden md:table-cell">NIP / Position</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none hidden lg:table-cell">Department</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">Role</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">Status</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600">
                    @forelse ($users as $user)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="avatar placeholder shrink-0">
                                        <div class="bg-blue-100 text-blue-700 rounded-xl w-9">
                                            <span class="text-sm font-bold">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-800 truncate">{{ $user->name }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5 truncate">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 hidden md:table-cell">
                                <div class="font-medium text-slate-700 text-[13px]">{{ $user->nip ?: '—' }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $user->position ?: '—' }}</div>
                            </td>
                            <td class="px-5 py-3.5 text-[13px] text-slate-500 hidden lg:table-cell">{{ $user->department ?: '—' }}</td>
                            <td class="px-5 py-3.5">
                                @php
                                    $roleClass = match($user->role) {
                                        'admin'  => 'bg-rose-50 text-rose-600 border-rose-200',
                                        'staff'  => 'bg-blue-50 text-blue-600 border-blue-200',
                                        'viewer' => 'bg-slate-100 text-slate-600 border-slate-200',
                                        default  => 'bg-slate-100 text-slate-600 border-slate-200',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold border {{ $roleClass }} capitalize">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-xs bg-blue-50 text-blue-600 border-blue-200 hover:bg-blue-100 rounded-md shadow-sm transition-colors" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        @if($user->is_active)
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Deactivate {{ addslashes($user->name) }}?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-xs bg-amber-50 text-amber-600 border-amber-200 hover:bg-amber-100 rounded-md shadow-sm transition-colors" title="Deactivate">
                                                <i class="bi bi-person-dash"></i>
                                            </button>
                                        </form>
                                        @else
                                        <span class="btn btn-xs bg-slate-50 text-slate-300 border-slate-100 rounded-md cursor-default" title="Already inactive">
                                            <i class="bi bi-person-dash"></i>
                                        </span>
                                        @endif
                                    @else
                                        <span class="btn btn-xs bg-slate-50 text-slate-300 border-slate-100 rounded-md cursor-default" title="Cannot deactivate yourself">
                                            <i class="bi bi-person-dash"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="p-5 bg-slate-50 rounded-full mb-4 border border-slate-100">
                                        <i class="bi bi-people text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">No Users Found</h3>
                                    <p class="text-sm text-slate-400 mb-5">
                                        @if(request('search') || request('role'))
                                            No users match your filter. <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">Clear filters</a>
                                        @else
                                            No users have been created yet.
                                        @endif
                                    </p>
                                    <a href="{{ route('users.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg px-5">
                                        <i class="bi bi-person-plus mr-1"></i> Create First User
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/30 flex items-center justify-between gap-4">
                <div class="text-xs text-slate-400 font-medium hidden sm:block">
                    Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
                </div>
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-layout>
