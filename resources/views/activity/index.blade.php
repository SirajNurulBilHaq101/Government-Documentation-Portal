<x-layout>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Activity Logs</h2>
            <p class="text-sm text-slate-500 mt-1">Monitor system usage and user actions</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-3 justify-between items-center">
            <form action="{{ route('activities.index') }}" method="GET" class="w-full sm:max-w-xs flex gap-2">
                <select name="user_id" class="select select-sm h-10 select-bordered w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm font-medium text-slate-600">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm h-10 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg px-4">
                    Filter
                </button>
            </form>
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-widest hidden sm:block shrink-0">
                {{ $activities->total() }} Events
            </div>
        </div>
        
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
                                <div class="font-semibold text-slate-700">{{ $log->created_at->format('M d, Y') }}</div>
                                <div class="text-[11px] font-medium text-slate-400 mt-0.5">{{ $log->created_at->format('h:i:s A') }}</div>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="avatar placeholder shrink-0">
                                        <div class="bg-blue-50 text-blue-600 rounded-full w-7 border border-blue-100">
                                            <span class="text-[10px] font-bold">{{ substr($log->user->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-700 truncate">{{ $log->user->name ?? 'Unknown' }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5 truncate hidden sm:block">{{ $log->user->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                @php
                                    $actionType = strtolower(explode(' ', $log->action)[0]);
                                    $badgeClass = 'bg-slate-100 text-slate-600 border-slate-200';
                                    
                                    if ($actionType == 'upload') $badgeClass = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                                    elseif ($actionType == 'edit') $badgeClass = 'bg-blue-50 text-blue-600 border-blue-200';
                                    elseif ($actionType == 'delete') $badgeClass = 'bg-rose-50 text-rose-600 border-rose-200';
                                    elseif ($actionType == 'download') $badgeClass = 'bg-indigo-50 text-indigo-600 border-indigo-200';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold border {{ $badgeClass }} capitalize tracking-wide">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 hidden md:table-cell">
                                @if($log->document)
                                    <a href="{{ route('documents.index', ['search' => $log->document->title]) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors text-sm">
                                        <i class="bi bi-file-earmark-text mr-1.5 text-slate-400"></i> {{ Str::limit($log->document->title, 35) }}
                                    </a>
                                @else
                                    <span class="inline-flex items-center text-slate-400 italic text-xs">
                                        <i class="bi bi-file-earmark-x mr-1.5 opacity-50"></i> Document unavailable
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-14">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="p-4 bg-slate-50 rounded-full mb-3">
                                        <i class="bi bi-activity text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">No Activity Logs</h3>
                                    <p class="text-sm text-slate-500">There are no system logs matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($activities->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/30">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</x-layout>
