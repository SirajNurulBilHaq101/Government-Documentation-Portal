<x-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-neutral">Activity Logs</h2>
        <p class="text-neutral/70 mt-1">Monitor system usage and user actions</p>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-0">
            <div class="p-6 border-b border-base-200 bg-base-100/50">
                <form action="{{ route('activities.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 max-w-sm">
                        <div class="join w-full">
                            <select name="user_id" class="select select-bordered join-item w-full bg-base-100">
                                <option value="">All Users</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-neutral join-item">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="text-neutral/70 border-b border-base-300 text-sm bg-base-200/50">
                            <th class="font-semibold px-6 py-4">Timestamp</th>
                            <th class="font-semibold px-6 py-4">User</th>
                            <th class="font-semibold px-6 py-4">Action</th>
                            <th class="font-semibold px-6 py-4">Related Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $log)
                            <tr class="border-b border-base-200 hover:bg-base-200/30 transition-colors">
                                <td class="px-6 py-4 text-sm text-neutral/70">
                                    <div class="font-medium text-neutral">{{ $log->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs">{{ $log->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content rounded-full w-8">
                                                <span class="text-xs uppercase">{{ substr($log->user->name ?? 'U', 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-medium text-neutral">{{ $log->user->name ?? 'Unknown' }}</div>
                                            <div class="text-xs text-neutral/60">{{ $log->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $actionType = strtolower(explode(' ', $log->action)[0]);
                                        $badgeColor = 'badge-ghost';
                                        
                                        if ($actionType == 'upload') $badgeColor = 'badge-success text-white';
                                        elseif ($actionType == 'edit') $badgeColor = 'badge-info text-white';
                                        elseif ($actionType == 'delete') $badgeColor = 'badge-error text-white';
                                        elseif ($actionType == 'download') $badgeColor = 'badge-primary text-white';
                                    @endphp
                                    <span class="badge {{ $badgeColor }} badge-sm font-medium capitalize px-2 py-3">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($log->document)
                                        <a href="{{ route('documents.index', ['search' => $log->document->title]) }}" class="text-info hover:underline font-medium flex items-center gap-2">
                                            <i class="bi bi-file-earmark-text"></i> {{ $log->document->title }}
                                        </a>
                                    @else
                                        <span class="text-neutral/50 italic"><i class="bi bi-file-earmark-x"></i> Document unavailable</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-neutral/50">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="bi bi-activity text-4xl mb-2 text-base-300"></i>
                                        <p>No activity logs found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($activities->hasPages())
                <div class="p-4 border-t border-base-200 flex justify-end">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
