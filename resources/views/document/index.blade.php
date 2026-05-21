<x-layout>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Documents</h2>
            <p class="text-sm text-slate-500 mt-1">Manage portal documents and files</p>
        </div>
        <a href="{{ route('documents.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 px-5 rounded-lg font-medium">
            <i class="bi bi-cloud-upload mr-1"></i> Upload Document
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100">
            <form action="{{ route('documents.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1 md:max-w-sm">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..." class="input input-sm h-10 input-bordered w-full pl-10 bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm" />
                </div>
                <div class="flex gap-2">
                    <select name="category_id" class="select select-sm h-10 select-bordered w-full md:w-44 bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm font-medium text-slate-600">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm h-10 bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200 rounded-lg px-4">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>
            </form>
        </div>
        
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
                                        <div class="font-semibold text-slate-800 truncate">{{ $document->title }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5 truncate">{{ Str::limit($document->description, 40) }}</div>
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
                            <td class="px-5 py-3.5 text-[13px] text-slate-500 hidden lg:table-cell">
                                {{ $document->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('documents.preview', $document->id) }}" target="_blank" class="btn btn-xs bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200 rounded-md shadow-sm transition-colors" title="Preview">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-xs bg-emerald-50 text-emerald-600 border-emerald-200 hover:bg-emerald-100 rounded-md shadow-sm transition-colors" title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-xs bg-blue-50 text-blue-600 border-blue-200 hover:bg-blue-100 rounded-md shadow-sm transition-colors" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Delete this document?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs bg-rose-50 text-rose-600 border-rose-200 hover:bg-rose-100 rounded-md shadow-sm transition-colors" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-14">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="p-4 bg-slate-50 rounded-full mb-3">
                                        <i class="bi bi-file-earmark-x text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">No Documents Found</h3>
                                    <p class="text-sm text-slate-500 mb-4">No documents match your search criteria.</p>
                                    <a href="{{ route('documents.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg px-5">
                                        Upload Document
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($documents->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/30">
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</x-layout>