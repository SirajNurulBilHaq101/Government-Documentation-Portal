<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Documents', 'url' => route('documents.index')],
        ['label' => $document->title, 'url' => route('documents.show', $document->id)],
        ['label' => 'Edit'],
    ]" />

    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-circle btn-ghost bg-white border border-slate-200 shadow-sm text-slate-500 hover:text-slate-800 shrink-0">
            <i class="bi bi-arrow-left text-lg leading-none"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Edit Document</h1>
            <p class="text-sm text-slate-500 mt-1 truncate max-w-md">{{ $document->title }}</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="card-body p-5 md:p-8">
            <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="space-y-5 mb-6">

                    {{-- Title --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Document Title <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $document->title) }}" placeholder="Enter document title"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm @error('title') border-rose-400 bg-rose-50 @enderror" required />
                        @error('title')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Category <span class="text-rose-500">*</span></span>
                        </label>
                        <select name="category_id"
                            class="select select-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm font-medium text-slate-600 @error('category_id') border-rose-400 bg-rose-50 @enderror" required>
                            <option value="" disabled>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Description</span>
                            <span class="label-text-alt text-slate-400">Optional</span>
                        </label>
                        <textarea name="description" rows="4" placeholder="Brief description of this document..."
                            class="textarea textarea-bordered w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm leading-relaxed @error('description') border-rose-400 bg-rose-50 @enderror">{{ old('description', $document->description) }}</textarea>
                        @error('description')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    {{-- File Replace --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5 flex justify-between items-end">
                            <span class="label-text text-sm font-semibold text-slate-700">Replace PDF File</span>
                            <span class="label-text-alt text-slate-400">Optional — leave blank to keep current</span>
                        </label>
                        {{-- Current file info --}}
                        <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 mb-3">
                            <div class="p-2 bg-rose-50 text-rose-500 rounded-lg shrink-0">
                                <i class="bi bi-file-earmark-pdf-fill text-lg leading-none"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-medium text-slate-700 truncate">{{ basename($document->file_path) }}</div>
                                <div class="text-xs text-slate-400 mt-0.5">Current file</div>
                            </div>
                            <a href="{{ route('documents.preview', $document->id) }}" target="_blank"
                                class="btn btn-xs bg-white text-slate-500 border-slate-200 hover:bg-slate-50 rounded-md shrink-0">
                                <i class="bi bi-eye mr-1"></i> Preview
                            </a>
                        </div>
                        <input type="file" name="file" accept=".pdf"
                            class="file-input file-input-bordered file-input-sm w-full bg-white border-slate-200 rounded-lg text-sm @error('file') file-input-error @enderror" />
                        @error('file')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">Cancel</a>
                    <button type="submit" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                        <i class="bi bi-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
