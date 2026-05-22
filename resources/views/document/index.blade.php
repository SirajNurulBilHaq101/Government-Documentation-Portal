<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Documents'],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Documents</h1>
            <p class="text-sm text-slate-500 mt-1">Manage portal documents and files</p>
        </div>
        @if(auth()->user()->canManage())
        <a href="{{ route('documents.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 px-5 rounded-lg font-medium">
            <i class="bi bi-cloud-upload mr-1"></i> Upload Document
        </a>
        @endif
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
        <div class="px-5 py-4 border-b border-slate-100">
            <form action="{{ route('documents.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1 md:max-w-sm">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..."
                        class="input input-sm h-10 input-bordered w-full pl-10 bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm" />
                </div>
                <div class="flex gap-2">
                    <select name="category_id" class="select select-sm h-10 select-bordered w-full md:w-44 bg-slate-50 border-slate-200 focus:border-blue-500 transition-all rounded-lg text-sm font-medium text-slate-600">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm h-10 bg-blue-600 hover:bg-blue-700 text-white border-none rounded-lg px-4 shadow-sm">
                        <i class="bi bi-funnel mr-1"></i> Filter
                    </button>
                    @if(request('search') || request('category_id'))
                    <a href="{{ route('documents.index') }}" class="btn btn-sm h-10 bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200 rounded-lg px-4">
                        <i class="bi bi-x-lg"></i>
                    </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="table w-full text-sm">
                <thead>
                    <tr class="text-slate-400 border-b border-slate-200 text-xs uppercase tracking-wider bg-slate-50/50">
                        <th class="font-semibold px-5 py-3.5 rounded-none">Title</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">Category</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none hidden md:table-cell">Uploaded By</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none hidden lg:table-cell">Date</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600">
                    @forelse ($documents as $document)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-rose-50 text-rose-500 rounded-lg shrink-0">
                                        <i class="bi bi-file-earmark-pdf-fill text-lg leading-none"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <a href="{{ route('documents.show', $document->id) }}"
                                            class="font-semibold text-slate-800 hover:text-blue-600 transition-colors truncate block">
                                            {{ $document->title }}
                                        </a>
                                        <div class="text-[11px] text-slate-400 mt-0.5 truncate">{{ Str::limit($document->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-600">
                                    {{ $document->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 hidden md:table-cell">
                                <div class="flex items-center gap-2">
                                    <div class="avatar placeholder">
                                        <div class="bg-slate-200 text-slate-600 rounded-full w-6">
                                            <span class="text-[10px] font-bold">{{ substr($document->uploader->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <span class="text-[13px] font-medium text-slate-600">{{ $document->uploader->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 hidden lg:table-cell">
                                <div class="text-[13px] text-slate-600">{{ $document->created_at->format('d M Y') }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $document->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('documents.show', $document->id) }}"
                                        class="btn btn-xs bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200 rounded-md shadow-sm transition-colors" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('documents.download', $document->id) }}"
                                        class="btn btn-xs bg-emerald-50 text-emerald-600 border-emerald-200 hover:bg-emerald-100 rounded-md shadow-sm transition-colors" title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin() || (auth()->user()->isStaff() && $document->uploaded_by === auth()->id()))
                                    <a href="{{ route('documents.edit', $document->id) }}"
                                        class="btn btn-xs bg-blue-50 text-blue-600 border-blue-200 hover:bg-blue-100 rounded-md shadow-sm transition-colors" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->isAdmin())
                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Delete this document permanently?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-xs bg-rose-50 text-rose-600 border-rose-200 hover:bg-rose-100 rounded-md shadow-sm transition-colors" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-16">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="p-5 bg-slate-50 rounded-full mb-4 border border-slate-100">
                                        <i class="bi bi-file-earmark-x text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">No Documents Found</h3>
                                    <p class="text-sm text-slate-400 mb-5">
                                        @if(request('search') || request('category_id'))
                                            No documents match your filter. <a href="{{ route('documents.index') }}" class="text-blue-600 hover:underline">Clear filters</a>
                                        @else
                                            No documents have been uploaded yet.
                                        @endif
                                    </p>
                                    @if(auth()->user()->canManage())
                                    <a href="{{ route('documents.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg px-5">
                                        <i class="bi bi-cloud-upload mr-1"></i> Upload First Document
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($documents->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/30 flex items-center justify-between gap-4">
                <div class="text-xs text-slate-400 font-medium hidden sm:block">
                    Showing {{ $documents->firstItem() }}–{{ $documents->lastItem() }} of {{ $documents->total() }} documents
                </div>
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</x-layout>