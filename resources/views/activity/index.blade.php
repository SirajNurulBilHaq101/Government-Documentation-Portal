<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Activity Logs'],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Activity Logs</h1>
            <p class="text-sm text-slate-500 mt-1">Monitor all system actions and user interactions</p>
        </div>
        <div class="flex items-center gap-2 bg-slate-100 border border-slate-200 rounded-xl px-3 py-2">
            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
            <span class="text-xs font-bold text-slate-600">{{ $activities->total() }} Total Events</span>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Filter Bar --}}
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-3 justify-between items-start sm:items-center">
            <form action="{{ route('activities.index') }}" method="GET" class="flex gap-2 w-full sm:max-w-md flex-wrap">
                <select name="user_id" class="select select-sm h-10 select-bordered flex-1 min-w-[140px] bg-slate-50 border-slate-200 focus:border-blue-500 transition-all rounded-lg text-sm font-medium text-slate-600">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <select name="action" class="select select-sm h-10 select-bordered w-36 bg-slate-50 border-slate-200 focus:border-blue-500 transition-all rounded-lg text-sm font-medium text-slate-600">
                    <option value="">All Actions</option>
                    <option value="upload"   {{ request('action') === 'upload'   ? 'selected' : '' }}>Upload</option>
                    <option value="edit"     {{ request('action') === 'edit'     ? 'selected' : '' }}>Edit</option>
                    <option value="download" {{ request('action') === 'download' ? 'selected' : '' }}>Download</option>
                    <option value="delete"   {{ request('action') === 'delete'   ? 'selected' : '' }}>Delete</option>
                </select>
                <button type="submit" class="btn btn-sm h-10 bg-blue-600 hover:bg-blue-700 text-white border-none rounded-lg px-4 shadow-sm">
                    <i class="bi bi-funnel mr-1"></i> Filter
                </button>
                @if(request('user_id') || request('action'))
                <a href="{{ route('activities.index') }}" class="btn btn-sm h-10 bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200 rounded-lg px-3">
                    <i class="bi bi-x-lg"></i>
                </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="table w-full text-sm">
                <thead>
                    <tr class="text-slate-400 border-b border-slate-200 text-xs uppercase tracking-wider bg-slate-50/50">
                        <th class="font-semibold px-5 py-3.5 rounded-none">Timestamp</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">User</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">Action</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none hidden md:table-cell">Related Document</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600">
                    @forelse ($activities as $log)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="font-semibold text-slate-700 text-[13px]">{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-[11px] font-medium text-slate-400 mt-0.5">{{ $log->created_at->format('H:i:s') }}</div>
                                <div class="text-[11px] text-slate-300 mt-0.5">{{ $log->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="avatar placeholder shrink-0">
                                        <div class="bg-blue-50 text-blue-600 rounded-full w-7 border border-blue-100">
                                            <span class="text-[10px] font-bold">{{ substr($log->user->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-700 text-[13px] truncate">{{ $log->user->name ?? 'Unknown' }}</div>
                                        <div class="text-[11px] text-slate-400 truncate hidden sm:block">{{ $log->user->role ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                @php
                                    $actionType  = strtolower(explode(' ', $log->action)[0]);
                                    $badgeClass  = match($actionType) {
                                        'upload'   => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                        'edit'     => 'bg-blue-50 text-blue-600 border-blue-200',
                                        'delete'   => 'bg-rose-50 text-rose-600 border-rose-200',
                                        'download' => 'bg-indigo-50 text-indigo-600 border-indigo-200',
                                        default    => 'bg-slate-100 text-slate-600 border-slate-200',
                                    };
                                    $actionIcon  = match($actionType) {
                                        'upload'   => 'bi-cloud-upload-fill',
                                        'edit'     => 'bi-pencil-fill',
                                        'delete'   => 'bi-trash-fill',
                                        'download' => 'bi-download',
                                        default    => 'bi-activity',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold border {{ $badgeClass }} capitalize tracking-wide">
                                    <i class="bi {{ $actionIcon }}"></i> {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 hidden md:table-cell">
                                @if($log->document)
                                    <a href="{{ route('documents.show', $log->document->id) }}"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors text-[13px] gap-1.5">
                                        <i class="bi bi-file-earmark-text text-slate-400"></i>
                                        {{ Str::limit($log->document->title, 40) }}
                                    </a>
                                @else
                                    <span class="inline-flex items-center text-slate-400 italic text-xs gap-1.5">
                                        <i class="bi bi-file-earmark-x opacity-50"></i> Document unavailable
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-16">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="p-5 bg-slate-50 rounded-full mb-4 border border-slate-100">
                                        <i class="bi bi-clock-history text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">No Activity Logs</h3>
                                    <p class="text-sm text-slate-400">
                                        @if(request('user_id') || request('action'))
                                            No logs match your filter. <a href="{{ route('activities.index') }}" class="text-blue-600 hover:underline">Clear filters</a>
                                        @else
                                            No system activity has been recorded yet.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($activities->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/30 flex items-center justify-between gap-4">
                <div class="text-xs text-slate-400 font-medium hidden sm:block">
                    Showing {{ $activities->firstItem() }}–{{ $activities->lastItem() }} of {{ $activities->total() }} events
                </div>
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</x-layout>
