<x-layout>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral">Categories</h2>
            <p class="text-neutral/70 mt-1">Manage document categories</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-neutral">
            <i class="bi bi-plus-lg"></i> Add Category
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
            <div class="p-6 border-b border-base-200 flex justify-between items-center bg-base-100/50">
                <form action="{{ route('categories.index') }}" method="GET" class="w-full max-w-md flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..." class="input input-bordered w-full bg-base-100" />
                    <button type="submit" class="btn btn-neutral btn-square">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="text-neutral/70 border-b border-base-300 text-sm bg-base-200/50">
                            <th class="font-semibold px-6 py-4">ID</th>
                            <th class="font-semibold px-6 py-4">Name</th>
                            <th class="font-semibold px-6 py-4">Description</th>
                            <th class="font-semibold px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b border-base-200 hover:bg-base-200/30 transition-colors">
                                <td class="px-6 py-4">{{ $category->id }}</td>
                                <td class="px-6 py-4 font-medium text-neutral">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-neutral/80">{{ Str::limit($category->description, 50) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-ghost text-info hover:bg-info/10">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-ghost text-error hover:bg-error/10">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-neutral/50">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($categories->hasPages())
                <div class="p-4 border-t border-base-200 flex justify-end">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
