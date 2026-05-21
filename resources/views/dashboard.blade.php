<x-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Dashboard Overview</h2>
        <p class="text-sm text-slate-500 mt-1">Welcome back, <span class="font-semibold">{{ Auth::user()->name ?? 'Admin' }}</span>. Here is what's happening today.</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-6">
        <!-- Stat Card 1 -->
        <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="card-body p-5">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Documents</h3>
                        <div class="text-3xl font-extrabold text-slate-800">{{ number_format($totalDocuments) }}</div>
                    </div>
                    <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl">
                        <i class="bi bi-file-earmark-text text-xl leading-none"></i>
                    </div>
                </div>
                <div class="text-xs font-medium text-slate-400 mt-1">Total files in portal</div>
            </div>
        </div>
        
        <!-- Stat Card 2 -->
        <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="card-body p-5">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Active Users</h3>
                        <div class="text-3xl font-extrabold text-slate-800">{{ number_format($activeUsers) }}</div>
                    </div>
                    <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl">
                        <i class="bi bi-people text-xl leading-none"></i>
                    </div>
                </div>
                <div class="text-xs font-medium text-slate-400 mt-1">Currently active accounts</div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="card-body p-5">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Categories</h3>
                        <div class="text-3xl font-extrabold text-slate-800">{{ number_format($totalCategories) }}</div>
                    </div>
                    <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                        <i class="bi bi-tags text-xl leading-none"></i>
                    </div>
                </div>
                <div class="text-xs font-medium text-slate-400 mt-1">Document classifications</div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="card-body p-5">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Activities</h3>
                        <div class="text-3xl font-extrabold text-slate-800">{{ number_format($totalActivities) }}</div>
                    </div>
                    <div class="p-2.5 bg-amber-50 text-amber-600 rounded-xl">
                        <i class="bi bi-activity text-xl leading-none"></i>
                    </div>
                </div>
                <div class="text-xs font-medium text-slate-400 mt-1">Logged system events</div>
            </div>
        </div>
    </div>

    <!-- Recent Data Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Recent Documents -->
        <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 lg:col-span-2 flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Recent Documents</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Latest files added to the portal</p>
                </div>
                <a href="{{ route('documents.index') }}" class="btn btn-xs bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200 rounded-md shadow-sm font-semibold px-3 transition-colors">View All</a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="table w-full text-sm">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-200 text-xs uppercase tracking-wider bg-slate-50/50">
                            <th class="font-semibold px-5 py-3 rounded-none">Document</th>
                            <th class="font-semibold px-5 py-3 rounded-none hidden sm:table-cell">Category</th>
                            <th class="font-semibold px-5 py-3 rounded-none hidden md:table-cell">Date</th>
                            <th class="font-semibold px-5 py-3 rounded-none text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-600">
                        @forelse($recentDocuments as $doc)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-rose-50 text-rose-500 rounded-lg shrink-0">
                                            <i class="bi bi-file-earmark-pdf-fill text-base leading-none"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-semibold text-slate-700 truncate">{{ Str::limit($doc->title, 35) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 hidden sm:table-cell">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-600">
                                        {{ $doc->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-[13px] text-slate-500 hidden md:table-cell">{{ $doc->created_at->format('M d, Y') }}</td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('documents.preview', $doc->id) }}" target="_blank" class="btn btn-xs bg-blue-50 text-blue-600 border-blue-200 hover:bg-blue-100 rounded-md shadow-sm transition-colors font-medium">Preview</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <div class="p-3 bg-slate-50 rounded-full mb-2">
                                            <i class="bi bi-folder-x text-2xl"></i>
                                        </div>
                                        <p class="font-medium text-slate-500 text-sm">No documents yet</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Recent Activity</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Timeline of system events</p>
                </div>
                <a href="{{ route('activities.index') }}" class="btn btn-xs bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200 rounded-md shadow-sm font-semibold px-3 transition-colors">View All</a>
            </div>
            
            <div class="p-5 flex-1 overflow-y-auto">
                <div class="flex flex-col gap-4">
                    @forelse($recentActivities as $activity)
                        <div class="flex gap-3 items-start relative">
                            {{-- Timeline connector --}}
                            @if(!$loop->last)
                                <div class="absolute top-9 bottom-[-16px] left-[15px] w-px bg-slate-100"></div>
                            @endif

                            @php
                                $actionType = strtolower(explode(' ', $activity->action)[0]);
                                $iconClass = 'bi-activity text-slate-500';
                                $bgClass = 'bg-slate-100 border-slate-200';
                                
                                if ($actionType == 'upload') { $iconClass = 'bi-cloud-upload-fill text-emerald-500'; $bgClass = 'bg-emerald-50 border-emerald-100'; }
                                elseif ($actionType == 'edit') { $iconClass = 'bi-pencil-fill text-blue-500'; $bgClass = 'bg-blue-50 border-blue-100'; }
                                elseif ($actionType == 'delete') { $iconClass = 'bi-trash-fill text-rose-500'; $bgClass = 'bg-rose-50 border-rose-100'; }
                                elseif ($actionType == 'download') { $iconClass = 'bi-download text-indigo-500'; $bgClass = 'bg-indigo-50 border-indigo-100'; }
                            @endphp
                            
                            <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 border shadow-sm z-10 {{ $bgClass }}">
                                <i class="bi {{ $iconClass }} text-xs"></i>
                            </div>
                            
                            <div class="pt-0.5 min-w-0">
                                <p class="text-[13px] text-slate-600 leading-snug">
                                    <span class="font-bold text-slate-800">{{ $activity->user->name ?? 'Unknown' }}</span> 
                                    {{ $activity->action }}
                                </p>
                                <p class="text-[11px] font-medium text-slate-400 mt-1 flex items-center gap-1">
                                    <i class="bi bi-clock"></i> {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400">
                            <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                            <p class="text-sm font-medium">No recent activity</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>