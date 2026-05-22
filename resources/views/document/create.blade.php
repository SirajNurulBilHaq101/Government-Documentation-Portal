<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Documents', 'url' => route('documents.index')],
        ['label' => 'Upload Document'],
    ]" />

    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('documents.index') }}" class="btn btn-sm btn-circle btn-ghost bg-white border border-slate-200 shadow-sm text-slate-500 hover:text-slate-800 shrink-0">
            <i class="bi bi-arrow-left text-lg leading-none"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Upload Document</h1>
            <p class="text-sm text-slate-500 mt-1">Add a new document to the portal</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="card-body p-5 md:p-8">
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-5 mb-6">

                    {{-- Title --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Document Title <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter document title"
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

                    {{-- Description --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Description</span>
                            <span class="label-text-alt text-slate-400">Optional</span>
                        </label>
                        <textarea name="description" rows="4" placeholder="Brief description of this document..."
                            class="textarea textarea-bordered w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm leading-relaxed @error('description') border-rose-400 bg-rose-50 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    {{-- File Upload --}}
                    <div class="form-control w-full">
                        <label class="label pb-1.5 flex justify-between items-end">
                            <span class="label-text text-sm font-semibold text-slate-700">PDF File <span class="text-rose-500">*</span></span>
                            <span class="text-[11px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded">Max: 10 MB</span>
                        </label>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 bg-slate-50 text-center @error('file') border-rose-300 bg-rose-50 @enderror">
                            <i class="bi bi-cloud-upload text-3xl text-slate-300 block mb-2"></i>
                            <p class="text-sm text-slate-500 mb-3">Select a PDF file to upload</p>
                            <input type="file" name="file" id="file-input" accept=".pdf"
                                class="file-input file-input-bordered file-input-sm w-full max-w-xs bg-white border-slate-200 rounded-lg text-sm @error('file') file-input-error @enderror" required />
                        </div>
                        @error('file')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <a href="{{ route('documents.index') }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">Cancel</a>
                    <button type="submit" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                        <i class="bi bi-cloud-upload mr-1"></i> Upload Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
