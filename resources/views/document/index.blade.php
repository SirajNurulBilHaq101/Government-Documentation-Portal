<x-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral">Documents</h2>
            <p class="text-neutral/70 mt-1">Manage portal documents and files</p>
        </div>
        <a href="{{ route('documents.create') }}" class="btn btn-neutral">
            <i class="bi bi-cloud-upload"></i> Upload Document
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm mb-6 text-white font-medium">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-0">
            <div class="p-6 border-b border-base-200 bg-base-100/50">
                <form action="{{ route('documents.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="join w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search documents by title..." class="input input-bordered join-item w-full bg-base-100" />
                            <select name="category_id" class="select select-bordered join-item bg-base-100">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-neutral join-item">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="text-neutral/70 border-b border-base-300 text-sm bg-base-200/50">
                            <th class="font-semibold px-6 py-4">Title</th>
                            <th class="font-semibold px-6 py-4">Category</th>
                            <th class="font-semibold px-6 py-4">Uploaded By</th>
                            <th class="font-semibold px-6 py-4">Date</th>
                            <th class="font-semibold px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($documents as $document)
                            <tr class="border-b border-base-200 hover:bg-base-200/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-error/10 text-error rounded-lg">
                                            <i class="bi bi-file-earmark-pdf-fill text-xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-neutral">{{ $document->title }}</div>
                                            <div class="text-xs text-neutral/70">{{ Str::limit($document->description, 40) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="badge badge-ghost badge-sm font-medium">{{ $document->category->name ?? 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content rounded-full w-6">
                                                <span class="text-[10px] uppercase">{{ substr($document->uploader->name ?? 'U', 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-neutral/80">{{ $document->uploader->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-neutral/70">
                                    {{ $document->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('documents.preview', $document->id) }}" target="_blank" class="btn btn-sm btn-ghost text-neutral hover:bg-neutral/10" title="Preview">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-ghost text-success hover:bg-success/10" title="Download">
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <div class="divider divider-horizontal mx-0 w-2"></div>
                                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-ghost text-info hover:bg-info/10" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-ghost text-error hover:bg-error/10" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-neutral/50">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="bi bi-file-earmark-x text-4xl mb-2 text-base-300"></i>
                                        <p>No documents found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($documents->hasPages())
                <div class="p-4 border-t border-base-200 flex justify-end">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>