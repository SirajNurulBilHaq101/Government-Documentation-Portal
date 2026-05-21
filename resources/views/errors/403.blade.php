<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Access Denied | GovDocs Portal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="text-center max-w-md w-full">

        {{-- Icon --}}
        <div class="flex justify-center mb-6">
            <div class="w-24 h-24 rounded-full bg-rose-50 border-2 border-rose-100 flex items-center justify-center">
                <i class="bi bi-shield-lock text-4xl text-rose-500"></i>
            </div>
        </div>

        {{-- Error Code --}}
        <div class="text-7xl font-black text-slate-200 leading-none mb-2 select-none">403</div>

        {{-- Title --}}
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-2">Access Denied</h1>

        {{-- Message --}}
        <p class="text-slate-500 text-sm leading-relaxed mb-8">
            {{ $exception->getMessage() ?? "You don't have permission to access this page. Contact your administrator if you believe this is an error." }}
        </p>

        {{-- Role Info --}}
        @auth
        <div class="inline-flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-2.5 shadow-sm mb-8">
            <i class="bi bi-person-badge text-slate-400"></i>
            <span class="text-xs font-medium text-slate-500">Logged in as</span>
            <span class="text-xs font-bold text-slate-700">{{ auth()->user()->name }}</span>
            @php
                $roleClass = match(auth()->user()->role) {
                    'admin'  => 'bg-rose-50 text-rose-600 border-rose-200',
                    'staff'  => 'bg-blue-50 text-blue-600 border-blue-200',
                    'viewer' => 'bg-slate-100 text-slate-600 border-slate-200',
                    default  => 'bg-slate-100 text-slate-600 border-slate-200',
                };
            @endphp
            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded border {{ $roleClass }}">
                {{ auth()->user()->role }}
            </span>
        </div>
        @endauth

        {{-- Actions --}}
        <div class="flex items-center justify-center gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-sm h-10 px-6 bg-white hover:bg-slate-50 text-slate-600 border-slate-200 shadow-sm rounded-lg font-medium">
                <i class="bi bi-arrow-left mr-1"></i> Go Back
            </a>
            <a href="{{ url('/') }}" class="btn btn-sm h-10 px-6 bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm shadow-blue-600/20 rounded-lg font-medium">
                <i class="bi bi-grid-1x2-fill mr-1"></i> Dashboard
            </a>
        </div>

    </div>

</body>
</html>
