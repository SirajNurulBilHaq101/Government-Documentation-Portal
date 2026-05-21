<x-layout>
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('categories.index') }}" class="btn btn-circle btn-ghost bg-base-200 border border-base-300">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-neutral">Edit Category</h2>
            <p class="text-neutral/70 mt-1">Update document category information</p>
        </div>
    </div>

    <div class="card max-w-2xl bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text font-medium text-neutral">Category Name <span class="text-error">*</span></span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter category name" class="input input-bordered w-full @error('name') input-error @enderror" required />
                    @error('name')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text font-medium text-neutral">Description</span>
                    </label>
                    <textarea name="description" placeholder="Enter category description (optional)" class="textarea textarea-bordered h-24 w-full @error('description') textarea-error @enderror">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-base-200">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline border-base-300 text-neutral">Cancel</a>
                    <button type="submit" class="btn btn-neutral">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
