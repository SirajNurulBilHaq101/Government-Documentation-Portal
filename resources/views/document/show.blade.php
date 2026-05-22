<x-layout>
    @php
        $user = auth()->user();
        $canEdit = $user->isAdmin() || ($user->isStaff() && $document->uploaded_by === $user->id);
        $canDelete = $user->isAdmin();

        $actionMap = [
            'upload' => [
                'icon' => 'bi-cloud-upload-fill',
                'bg' => 'bg-emerald-50 border-emerald-100',
                'text' => 'text-emerald-600',
            ],
            'edit' => ['icon' => 'bi-pencil-fill', 'bg' => 'bg-blue-50 border-blue-100', 'text' => 'text-blue-600'],
            'download' => [
                'icon' => 'bi-download',
                'bg' => 'bg-indigo-50 border-indigo-100',
                'text' => 'text-indigo-600',
            ],
            'delete' => ['icon' => 'bi-trash-fill', 'bg' => 'bg-rose-50 border-rose-100', 'text' => 'text-rose-600'],
        ];
    @endphp

    {{-- ═══ BREADCRUMB + PAGE HEADER ════════════════════════════════════════ --}}
    <div class="mb-6">
        {{-- Breadcrumb --}}
        <div class="text-xs font-medium text-slate-400 flex items-center gap-1.5 mb-4 flex-wrap">
            <a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
            <i class="bi bi-chevron-right text-[10px]"></i>
            <a href="{{ route('documents.index') }}" class="hover:text-blue-600 transition-colors">Documents</a>
            <i class="bi bi-chevron-right text-[10px]"></i>
            <span class="text-slate-600 font-semibold truncate max-w-[200px]">{{ $document->title }}</span>
        </div>

        {{-- Title row --}}
        <div class="flex flex-col lg:flex-row lg:items-start gap-4">

            {{-- Icon + Title + Badges --}}
            <div class="flex items-start gap-4 flex-1 min-w-0">
                <div class="bg-rose-50 text-rose-500 rounded-2xl border border-rose-100 shadow-sm shrink-0">
                    <i class="bi bi-file-earmark-pdf-fill text-3xl leading-none"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight leading-snug">
                        {{ $document->title }}</h1>
                    
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-blue-50 text-blue-600 border border-blue-200">
                        <i class="bi bi-tag"></i> {{ $document->category->name ?? 'Uncategorized' }}
                    </span>
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-rose-50 text-rose-600 border border-rose-200">
                        <i class="bi bi-filetype-pdf"></i> PDF
                    </span>
                    @if ($fileSize)
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                            <i class="bi bi-hdd"></i> {{ \App\Helpers\FileHelper::formatBytes($fileSize) }}
                        </span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @if (session('success'))
        <div
            class="alert bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl shadow-sm mb-5 flex items-center gap-2">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- ═══ MAIN GRID ══════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ── LEFT COLUMN ──────────────────────────────────────────────────── --}}
        <div class="xl:col-span-2 flex flex-col gap-5">

            {{-- PDF Preview --}}
            <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                        <h2 class="text-sm font-bold text-slate-700">Document Preview</h2>
                    </div>
                    @if ($fileExists)
                        <a href="{{ route('documents.preview', $document->id) }}" target="_blank"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1">
                            Open in new tab <i class="bi bi-box-arrow-up-right text-[11px]"></i>
                        </a>
                    @endif
                </div>

                @if ($fileExists)
                    <div class="relative bg-slate-100 w-full" style="height:600px">
                        <iframe src="{{ route('documents.preview', $document->id) }}" class="w-full h-full border-0"
                            title="{{ $document->title }}" loading="lazy">
                        </iframe>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 px-8 text-center">
                        <div
                            class="w-16 h-16 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center mb-4">
                            <i class="bi bi-file-earmark-x text-3xl text-slate-300"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-600 mb-1">File Not Found</h3>
                        <p class="text-sm text-slate-400">The physical file for this document is missing from storage.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Description --}}
            <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                    <h2 class="text-sm font-bold text-slate-700">Description</h2>
                </div>
                <div class="p-5">
                    @if ($document->description)
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $document->description }}</p>
                    @else
                        <div class="flex items-center gap-3 text-slate-400 py-4">
                            <i class="bi bi-card-text text-2xl opacity-40"></i>
                            <div>
                                <p class="text-sm font-semibold text-slate-500">No description provided</p>
                                <p class="text-xs text-slate-400 mt-0.5">This document was uploaded without a
                                    description.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Activity Timeline --}}
            <div class="card bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                    <h2 class="text-sm font-bold text-slate-700">Activity Timeline</h2>
                    <span class="ml-auto text-xs font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded">
                        {{ $activities->count() }} event{{ $activities->count() !== 1 ? 's' : '' }}
                    </span>
                </div>
                <div class="p-5">
                    @if ($activities->isNotEmpty())
                        <div class="flex flex-col">
                            @foreach ($activities as $activity)
                                @php
                                    $actionKey = strtolower(explode(' ', $activity->action)[0]);
                                    $style = $actionMap[$actionKey] ?? [
                                        'icon' => 'bi-activity',
                                        'bg' => 'bg-slate-100 border-slate-200',
                                        'text' => 'text-slate-500',
                                    ];
                                @endphp
                                <div class="flex gap-4 relative pb-5 last:pb-0">
                                    @if (!$loop->last)
                                        <div class="absolute top-9 left-[15px] bottom-0 w-px bg-slate-100"></div>
                                    @endif
                                    <div
                                        class="w-8 h-8 rounded-full border flex items-center justify-center shrink-0 z-10 shadow-sm {{ $style['bg'] }}">
                                        <i class="bi {{ $style['icon'] }} text-xs {{ $style['text'] }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0 pt-0.5">
                                        <p class="text-sm text-slate-600 leading-snug">
                                            <span
                                                class="font-bold text-slate-800">{{ $activity->user->name ?? 'Unknown User' }}</span>
                                            <span class="mx-1">·</span>
                                            <span class="capitalize">{{ $activity->action }}</span>
                                        </p>
                                        <p class="text-[11px] font-medium text-slate-400 mt-1 flex items-center gap-1">
                                            <i class="bi bi-clock"></i>
                                            <span title="{{ $activity->created_at->format('d M Y, H:i:s') }}">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </span>
                                            <span class="text-slate-200 mx-0.5">·</span>
                                            {{ $activity->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div
                                class="w-14 h-14 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center mb-3">
                                <i class="bi bi-clock-history text-2xl text-slate-300"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-600 mb-1">No Activity Yet</p>
                            <p class="text-xs text-slate-400">No events have been recorded for this document.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ── RIGHT COLUMN — Metadata (sticky on desktop) ──────────────────── --}}
        <div class="xl:col-span-1">
            <div class="xl:sticky xl:top-24 flex flex-col gap-5">

                {{-- Metadata Card --}}
                <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                        <h2 class="text-sm font-bold text-slate-700">Document Information</h2>
                    </div>
                    <div class="divide-y divide-slate-100">

                        <div class="px-5 py-3.5">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">File Name
                            </div>
                            @if ($fileName)
                                <div class="flex items-start gap-2">
                                    <i class="bi bi-file-earmark-pdf text-rose-400 mt-0.5 shrink-0"></i>
                                    <span
                                        class="text-sm font-medium text-slate-700 break-all">{{ $fileName }}</span>
                                </div>
                            @else
                                <span class="text-slate-400 italic text-xs">File unavailable</span>
                            @endif
                        </div>

                        <div class="px-5 py-3.5">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">File Size
                            </div>
                            <div class="text-sm font-semibold text-slate-700">
                                @if ($fileSize)
                                    <span class="flex items-center gap-1.5">
                                        <i class="bi bi-hdd text-slate-400"></i>
                                        {{ \App\Helpers\FileHelper::formatBytes($fileSize) }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic text-xs">Unknown</span>
                                @endif
                            </div>
                        </div>

                        <div class="px-5 py-3.5">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Category
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-blue-50 text-blue-600 border border-blue-200">
                                <i class="bi bi-tag"></i> {{ $document->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>

                        <div class="px-5 py-3.5">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Uploaded
                                By</div>
                            <div class="flex items-center gap-2.5">
                                <div class="avatar placeholder shrink-0">
                                    <div class="bg-blue-100 text-blue-700 rounded-lg w-8">
                                        <span
                                            class="text-xs font-bold">{{ substr($document->uploader->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-700">
                                        {{ $document->uploader->name ?? 'Unknown' }}</div>
                                    @if ($document->uploader)
                                        <div class="text-[11px] text-slate-400">
                                            {{ $document->uploader->position ?? $document->uploader->email }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="px-5 py-3.5">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Uploaded On
                            </div>
                            <div class="text-sm font-medium text-slate-700">
                                {{ $document->created_at->format('d M Y, H:i') }}</div>
                            <div class="text-[11px] font-medium text-slate-400 mt-0.5 flex items-center gap-1">
                                <i class="bi bi-clock"></i> {{ $document->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <div class="px-5 py-3.5">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Last
                                Updated</div>
                            <div class="text-sm font-medium text-slate-700">
                                {{ $document->updated_at->format('d M Y, H:i') }}</div>
                            <div class="text-[11px] font-medium text-slate-400 mt-0.5 flex items-center gap-1">
                                <i class="bi bi-clock"></i> {{ $document->updated_at->diffForHumans() }}
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-2 h-2 rounded-full bg-indigo-400"></div>
                        <h2 class="text-sm font-bold text-slate-700">Quick Actions</h2>
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        {{-- @if ($fileExists)
                            <a href="{{ route('documents.preview', $document->id) }}" target="_blank"
                                class="btn btn-sm h-10 bg-slate-50 hover:bg-slate-100 text-slate-700 border-slate-200 rounded-xl font-medium w-full justify-start gap-2.5 shadow-sm">
                                <i class="bi bi-eye text-slate-400"></i> Preview PDF
                            </a>
                            <a href="{{ route('documents.download', $document->id) }}"
                                class="btn btn-sm h-10 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border-emerald-200 rounded-xl font-medium w-full justify-start gap-2.5 shadow-sm">
                                <i class="bi bi-download text-emerald-500"></i> Download PDF
                            </a>
                        @else
                            <div class="text-center py-4 text-slate-400">
                                <i class="bi bi-exclamation-circle text-xl mb-2 block"></i>
                                <p class="text-xs font-medium">File not available</p>
                            </div>
                        @endif

                        @if ($canEdit)
                            <a href="{{ route('documents.edit', $document->id) }}"
                                class="btn btn-sm h-10 bg-blue-50 hover:bg-blue-100 text-blue-700 border-blue-200 rounded-xl font-medium w-full justify-start gap-2.5 shadow-sm">
                                <i class="bi bi-pencil text-blue-500"></i> Edit Document
                            </a>
                        @endif --}}

                        @if ($canDelete)
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST"
                                onsubmit="return confirm('Delete this document permanently?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm h-10 bg-rose-50 hover:bg-rose-100 text-rose-700 border-rose-200 rounded-xl font-medium w-full justify-start gap-2.5 shadow-sm">
                                    <i class="bi bi-trash text-rose-500"></i> Delete Document
                                </button>
                            </form>
                        @endif

                        <div class="border-t border-slate-100 pt-2 mt-1">
                            <a href="{{ route('documents.index') }}"
                                class="btn btn-sm h-10 bg-white hover:bg-slate-50 text-slate-500 border-slate-200 rounded-xl font-medium w-full justify-start gap-2.5 shadow-sm">
                                <i class="bi bi-arrow-left text-slate-400"></i> Back to Documents
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</x-layout>
