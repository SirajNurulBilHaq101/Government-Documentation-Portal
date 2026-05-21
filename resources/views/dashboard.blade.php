<x-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-neutral">Dashboard Overview</h2>
        <p class="text-neutral/70 mt-1">Welcome back, Admin. Here is what's happening today.</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-neutral/70 uppercase tracking-wider">Total Documents</h3>
                    <div class="p-2 bg-neutral text-neutral-content rounded-lg shadow-sm">
                        <i class="bi bi-file-earmark-text text-xl"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral">12,450</div>
                <div class="text-sm font-medium text-success mt-2 flex items-center gap-1">
                    <i class="bi bi-arrow-up-short text-lg"></i> 12% from last month
                </div>
            </div>
        </div>
        
        <!-- Stat Card 2 -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-neutral/70 uppercase tracking-wider">Active Users</h3>
                    <div class="p-2 bg-neutral text-neutral-content rounded-lg shadow-sm">
                        <i class="bi bi-people text-xl"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral">1,204</div>
                <div class="text-sm font-medium text-success mt-2 flex items-center gap-1">
                    <i class="bi bi-arrow-up-short text-lg"></i> 5% from last week
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-neutral/70 uppercase tracking-wider">Pending Approvals</h3>
                    <div class="p-2 bg-neutral text-neutral-content rounded-lg shadow-sm">
                        <i class="bi bi-clock-history text-xl"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral">48</div>
                <div class="text-sm font-medium text-error mt-2 flex items-center gap-1">
                    <i class="bi bi-arrow-down-short text-lg"></i> 2% from yesterday
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-neutral/70 uppercase tracking-wider">System Health</h3>
                    <div class="p-2 bg-neutral text-neutral-content rounded-lg shadow-sm">
                        <i class="bi bi-shield-check text-xl"></i>
                    </div>
                </div>
                <div class="text-3xl font-bold text-neutral">99.9%</div>
                <div class="text-sm font-medium text-success mt-2 flex items-center gap-1">
                    <i class="bi bi-check-circle text-sm"></i> All systems operational
                </div>
            </div>
        </div>
    </div>

    <!-- Charts / Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Documents -->
        <div class="card bg-base-100 shadow-sm border border-base-200 lg:col-span-2">
            <div class="card-body p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-neutral">Recent Documents</h3>
                    <button class="btn btn-sm btn-outline btn-neutral">View All</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="text-neutral/70 border-b border-base-300 text-sm">
                                <th class="font-semibold bg-transparent">Document Title</th>
                                <th class="font-semibold bg-transparent">Category</th>
                                <th class="font-semibold bg-transparent">Date</th>
                                <th class="font-semibold bg-transparent">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-base-200 hover:bg-base-200/50 transition-colors">
                                <td class="font-medium text-neutral">National Budget Report 2026</td>
                                <td class="text-neutral/80">Finance</td>
                                <td class="text-neutral/70">May 21, 2026</td>
                                <td><span class="badge badge-success text-white badge-sm px-2 py-3 font-medium">Published</span></td>
                            </tr>
                            <tr class="border-b border-base-200 hover:bg-base-200/50 transition-colors">
                                <td class="font-medium text-neutral">City Infrastructure Plan</td>
                                <td class="text-neutral/80">Development</td>
                                <td class="text-neutral/70">May 20, 2026</td>
                                <td><span class="badge badge-warning text-white badge-sm px-2 py-3 font-medium">Pending</span></td>
                            </tr>
                            <tr class="border-b border-base-200 hover:bg-base-200/50 transition-colors">
                                <td class="font-medium text-neutral">Healthcare Guidelines v2.0</td>
                                <td class="text-neutral/80">Health</td>
                                <td class="text-neutral/70">May 19, 2026</td>
                                <td><span class="badge badge-success text-white badge-sm px-2 py-3 font-medium">Published</span></td>
                            </tr>
                            <tr class="hover:bg-base-200/50 transition-colors border-none">
                                <td class="font-medium text-neutral">Education Sector Policy</td>
                                <td class="text-neutral/80">Education</td>
                                <td class="text-neutral/70">May 18, 2026</td>
                                <td><span class="badge badge-error text-white badge-sm px-2 py-3 font-medium">Draft</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h3 class="text-lg font-bold text-neutral mb-6">Quick Actions</h3>
                <div class="flex flex-col gap-3">
                    <button class="btn btn-neutral w-full justify-start text-base font-medium">
                        <i class="bi bi-upload mr-3 text-lg"></i> Upload Document
                    </button>
                    <button class="btn btn-outline border-base-300 text-neutral hover:bg-base-200 hover:border-base-300 hover:text-neutral w-full justify-start text-base font-medium">
                        <i class="bi bi-folder-plus mr-3 text-lg"></i> Create Category
                    </button>
                    <button class="btn btn-outline border-base-300 text-neutral hover:bg-base-200 hover:border-base-300 hover:text-neutral w-full justify-start text-base font-medium">
                        <i class="bi bi-person-plus mr-3 text-lg"></i> Add New User
                    </button>
                    <button class="btn btn-outline border-base-300 text-neutral hover:bg-base-200 hover:border-base-300 hover:text-neutral w-full justify-start text-base font-medium mt-4">
                        <i class="bi bi-gear mr-3 text-lg"></i> System Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>