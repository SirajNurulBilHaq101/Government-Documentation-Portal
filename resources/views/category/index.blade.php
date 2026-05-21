<x-layout>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Categories</h2>
            <p class="text-sm text-slate-500 mt-1">Manage all document classifications</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 px-5 rounded-lg font-medium">
            <i class="bi bi-plus-lg mr-1"></i> New Category
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-3 justify-between items-center">
            <form action="{{ route('categories.index') }}" method="GET" class="w-full sm:max-w-xs relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..." class="input input-sm h-10 input-bordered w-full pl-10 bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm" />
            </form>
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-widest hidden sm:block shrink-0">
                {{ $categories->total() }} Records
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full text-sm">
                <thead>
                    <tr class="text-slate-400 border-b border-slate-200 text-xs uppercase tracking-wider bg-slate-50/50">
                        <th class="font-semibold px-5 py-3.5 rounded-none w-16 text-center">ID</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">Category Name</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none">Description</th>
                        <th class="font-semibold px-5 py-3.5 rounded-none text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600">
                    @forelse ($categories as $category)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3.5 text-center font-medium text-slate-400">{{ $category->id }}</td>
                            <td class="px-5 py-3.5">
                                <div class="font-semibold text-slate-800">{{ $category->name }}</div>
                            </td>
                            <td class="px-5 py-3.5 text-slate-500">{{ Str::limit($category->description, 60) ?: '-' }}</td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs bg-blue-50 text-blue-600 border-blue-200 hover:bg-blue-100 rounded-md shadow-sm transition-colors" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?');">
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
                            <td colspan="4" class="text-center py-14">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="p-4 bg-slate-50 rounded-full mb-3">
                                        <i class="bi bi-tags text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-700 mb-1">No Categories Found</h3>
                                    <p class="text-sm text-slate-500 mb-4">You haven't created any document categories yet.</p>
                                    <a href="{{ route('categories.create') }}" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg px-5">
                                        Create First Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($categories->hasPages())
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/30">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</x-layout>
