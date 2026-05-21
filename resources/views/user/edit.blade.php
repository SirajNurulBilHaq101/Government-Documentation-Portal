<x-layout>
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-circle btn-ghost bg-white border border-slate-200 shadow-sm text-slate-500 hover:text-slate-800">
            <i class="bi bi-arrow-left text-lg leading-none"></i>
        </a>
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Edit User</h2>
            <p class="text-sm text-slate-500 mt-1">Update account information and access level</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="card-body p-5 md:p-8">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5 mb-6">

                    {{-- Name --}}
                    <div class="form-control md:col-span-2">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Full Name <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Full name" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('name') border-rose-300 @enderror" required />
                        @error('name')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Email <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('email') border-rose-300 @enderror" required />
                        @error('email')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- Username --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Username <span class="text-rose-500">*</span></span>
                        </label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('username') border-rose-300 @enderror" required />
                        @error('username')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- NIP --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">NIP</span>
                        </label>
                        <input type="text" name="nip" value="{{ old('nip', $user->nip) }}" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('nip') border-rose-300 @enderror" />
                        @error('nip')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- Position --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Position / Jabatan</span>
                        </label>
                        <input type="text" name="position" value="{{ old('position', $user->position) }}" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('position') border-rose-300 @enderror" />
                        @error('position')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- Department --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Department / Bidang</span>
                        </label>
                        <input type="text" name="department" value="{{ old('department', $user->department) }}" class="input input-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('department') border-rose-300 @enderror" />
                        @error('department')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- Role --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Role <span class="text-rose-500">*</span></span>
                        </label>
                        <select name="role" class="select select-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm font-medium text-slate-600 @error('role') border-rose-300 @enderror" required>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="viewer" {{ old('role', $user->role) === 'viewer' ? 'selected' : '' }}>Viewer</option>
                        </select>
                        @error('role')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                    {{-- Is Active --}}
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text text-sm font-semibold text-slate-700">Account Status <span class="text-rose-500">*</span></span>
                        </label>
                        <select name="is_active" class="select select-bordered h-11 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm font-medium text-slate-600 @error('is_active') border-rose-300 @enderror" {{ $user->id === auth()->id() ? 'disabled' : '' }} required>
                            <option value="1" {{ old('is_active', $user->is_active ? '1' : '0') === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $user->is_active ? '1' : '0') === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @if($user->id === auth()->id())
                            <input type="hidden" name="is_active" value="1">
                            <label class="label pt-1.5 pb-0"><span class="label-text-alt text-slate-400"><i class="bi bi-info-circle mr-1"></i> You cannot deactivate your own account.</span></label>
                        @endif
                        @error('is_active')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                    </div>

                </div>

                {{-- Password Section --}}
                <div class="border border-dashed border-slate-200 rounded-xl p-5 bg-slate-50/50 mb-6">
                    <h3 class="text-sm font-bold text-slate-700 mb-4 flex items-center gap-2">
                        <i class="bi bi-key text-slate-400"></i> Change Password
                        <span class="text-xs font-normal text-slate-400">(Leave blank to keep current)</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="form-control">
                            <label class="label pb-1.5"><span class="label-text text-sm font-semibold text-slate-700">New Password</span></label>
                            <input type="password" name="password" placeholder="Min. 8 characters" class="input input-bordered h-11 w-full bg-white border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm @error('password') border-rose-300 @enderror" />
                            @error('password')<label class="label pt-1 pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>@enderror
                        </div>
                        <div class="form-control">
                            <label class="label pb-1.5"><span class="label-text text-sm font-semibold text-slate-700">Confirm New Password</span></label>
                            <input type="password" name="password_confirmation" placeholder="Repeat new password" class="input input-bordered h-11 w-full bg-white border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-lg text-sm" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <a href="{{ route('users.index') }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">Cancel</a>
                    <button type="submit" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                        <i class="bi bi-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
