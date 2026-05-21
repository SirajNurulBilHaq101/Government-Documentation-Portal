<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Government Documentation Portal' }}</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- DaisyUI CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-base-200">

    <div class="drawer lg:drawer-open">

        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />

        {{-- Main Content --}}
        <div class="drawer-content flex flex-col min-h-screen">

            <x-header />

            {{-- Page Content --}}
            <main class="flex-1 p-6">

                {{ $slot }}

            </main>

            {{-- Footer --}}
            <footer class="footer footer-center bg-base-100 border-t border-base-300 p-4">

                <aside>
                    <p>
                        © {{ date('Y') }} Government Documentation Portal
                    </p>
                </aside>

            </footer>

        </div>

        <x-sidebar />

    </div>

</body>

</html>
