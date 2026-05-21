<x-layout>
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('documents.index') }}" class="btn btn-sm btn-circle btn-ghost bg-white border border-slate-200 shadow-sm text-slate-500 hover:text-slate-800">
            <i class="bi bi-arrow-left text-lg leading-none"></i>
        </a>
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Upload Document</h2>
            <p class="text-sm text-slate-500 mt-1">Add a new document to the portal</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="card-body p-5 md:p-8">
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-5 mb-6">
                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Document Title <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter document title" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm @error('title') border-rose-300 focus:ring-rose-100 focus:border-rose-500 @enderror" required />
                        @error('title')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Category <span class="text-rose-500">*</span></span>
                        </label>
                        <select name="category_id" class="select select-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm font-medium text-slate-600 @error('category_id') border-rose-300 focus:ring-rose-100 focus:border-rose-500 @enderror" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Description</span>
                        </label>
                        <textarea name="description" placeholder="Enter brief description (optional)" class="textarea textarea-bordered min-h-[100px] w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm leading-relaxed @error('description') border-rose-300 focus:ring-rose-100 focus:border-rose-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5 flex justify-between items-end">
                            <span class="label-text text-sm font-semibold text-slate-700">PDF File <span class="text-rose-500">*</span></span>
                            <span class="text-[11px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded">Max: 10MB</span>
                        </label>
                        <input type="file" name="file" accept=".pdf" class="file-input file-input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 transition-all rounded-lg text-sm @error('file') file-input-error border-rose-300 @enderror" required />
                        @error('file')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <a href="{{ route('documents.index') }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">Cancel</a>
                    <button type="submit" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                        <i class="bi bi-cloud-upload mr-1"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
