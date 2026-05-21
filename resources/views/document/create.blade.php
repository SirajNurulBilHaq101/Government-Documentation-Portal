<x-layout>
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('documents.index') }}" class="btn btn-circle btn-ghost bg-base-200 border border-base-300">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-neutral">Upload Document</h2>
            <p class="text-neutral/70 mt-1">Add a new document to the portal</p>
        </div>
    </div>

    <div class="card max-w-3xl bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-8">
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-control w-full md:col-span-2">
                        <label class="label">
                            <span class="label-text font-medium text-neutral">Document Title <span class="text-error">*</span></span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter document title" class="input input-bordered w-full @error('title') input-error @enderror" required />
                        @error('title')
                            <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label">
                            <span class="label-text font-medium text-neutral">Category <span class="text-error">*</span></span>
                        </label>
                        <select name="category_id" class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label">
                            <span class="label-text font-medium text-neutral">Description</span>
                        </label>
                        <textarea name="description" placeholder="Enter brief description (optional)" class="textarea textarea-bordered h-24 w-full @error('description') textarea-error @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label">
                            <span class="label-text font-medium text-neutral">PDF File <span class="text-error">*</span></span>
                            <span class="label-text-alt text-neutral/70">Max size: 10MB</span>
                        </label>
                        <input type="file" name="file" accept=".pdf" class="file-input file-input-bordered file-input-neutral w-full @error('file') file-input-error @enderror" required />
                        @error('file')
                            <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-base-200">
                    <a href="{{ route('documents.index') }}" class="btn btn-outline border-base-300 text-neutral px-8">Cancel</a>
                    <button type="submit" class="btn btn-neutral px-8">
                        <i class="bi bi-cloud-upload mr-2"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
