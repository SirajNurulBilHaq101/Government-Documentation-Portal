<x-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Users', 'url' => route('users.index')],
        ['label' => 'Create User'],
    ]" />

    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-circle btn-ghost bg-white border border-slate-200 shadow-sm text-slate-500 hover:text-slate-800 shrink-0">
            <i class="bi bi-arrow-left text-lg leading-none"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Create User</h1>
            <p class="text-sm text-slate-500 mt-1">Add a new system account</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 max-w-3xl">
        <div class="card-body p-5 md:p-8">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5 mb-6">

                    <div class="form-control md:col-span-2">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Full Name <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Budi Santoso"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('name') border-rose-400 bg-rose-50 @enderror" required />
                        @error('name')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Email <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@gov.go.id"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('email') border-rose-400 bg-rose-50 @enderror" required />
                        @error('email')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Username <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="e.g. budi_santoso"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('username') border-rose-400 bg-rose-50 @enderror" required />
                        @error('username')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">NIP</span>
                            <span class="label-text-alt text-slate-400">Optional</span>
                        </label>
                        <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Nomor Induk Pegawai"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('nip') border-rose-400 bg-rose-50 @enderror" />
                        @error('nip')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Position / Jabatan</span>
                        </label>
                        <input type="text" name="position" value="{{ old('position') }}" placeholder="e.g. Kepala Bidang"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('position') border-rose-400 bg-rose-50 @enderror" />
                        @error('position')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Department / Bidang</span>
                        </label>
                        <input type="text" name="department" value="{{ old('department') }}" placeholder="e.g. Bagian Umum"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('department') border-rose-400 bg-rose-50 @enderror" />
                        @error('department')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Role <span class="text-rose-500">*</span></span>
                        </label>
                        <select name="role" class="select select-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm font-medium text-slate-600 @error('role') border-rose-400 bg-rose-50 @enderror" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select role</option>
                            <option value="admin"  {{ old('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                            <option value="staff"  {{ old('role') === 'staff'  ? 'selected' : '' }}>Staff</option>
                            <option value="viewer" {{ old('role') === 'viewer' ? 'selected' : '' }}>Viewer</option>
                        </select>
                        @error('role')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Password <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="password" name="password" placeholder="Min. 8 characters"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('password') border-rose-400 bg-rose-50 @enderror" required />
                        @error('password')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Confirm Password <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="password" name="password_confirmation" placeholder="Repeat password"
                            class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm" required />
                    </div>

                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <a href="{{ route('users.index') }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">Cancel</a>
                    <button type="submit" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                        <i class="bi bi-person-plus mr-1"></i> Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
