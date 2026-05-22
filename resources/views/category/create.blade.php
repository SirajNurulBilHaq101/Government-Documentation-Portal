<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Categories', 'url' => route('categories.index')],
        ['label' => 'Create Category'],
    ]" />

    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-circle btn-ghost bg-white border border-slate-200 shadow-sm text-slate-500 hover:text-slate-800 shrink-0">
            <i class="bi bi-arrow-left text-lg leading-none"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Create Category</h1>
            <p class="text-sm text-slate-500 mt-1">Add a new classification for documents</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="card-body p-5 md:p-8">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="space-y-5 mb-6">
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Category Name <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Finance Reports"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm @error('name') border-rose-400 bg-rose-50 @enderror" required />
                        @error('name')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Description</span>
                            <span class="label-text-alt text-slate-400">Optional</span>
                        </label>
                        <textarea name="description" rows="4" placeholder="Brief explanation of what this category contains..."
                            class="textarea textarea-bordered w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all rounded-lg text-sm leading-relaxed @error('description') border-rose-400 bg-rose-50 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <a href="{{ route('categories.index') }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">Cancel</a>
                    <button type="submit" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                        <i class="bi bi-tag mr-1"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
