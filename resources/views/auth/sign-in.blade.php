<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign In</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- DaisyUI --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="min-h-screen bg-base-200 flex items-center justify-center">

    <div class="card bg-base-100 w-full max-w-md shadow-xl">

        <div class="card-body">

            <div class="text-center mb-6">

                <h1 class="text-3xl font-bold">
                    GovDocs
                </h1>

                <p class="text-base-content/70 mt-2">
                    Government Documentation Portal
                </p>

            </div>

            @if ($errors->any())
                <div class="alert alert-error mb-4">

                    <i class="bi bi-exclamation-circle"></i>

                    <span>
                        {{ $errors->first() }}
                    </span>

                </div>
            @endif

            <form action="{{ route('sign-in.post') }}" method="POST">

                @csrf

                <div class="form-control mb-4">

                    <label class="label">
                        <span class="label-text">
                            Email
                        </span>
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                        class="input input-bordered w-full" required>

                </div>

                <div class="form-control mb-4">

                    <label class="label">
                        <span class="label-text">
                            Password
                        </span>
                    </label>

                    <input type="password" name="password" placeholder="Enter your password"
                        class="input input-bordered w-full" required>

                </div>

                <div class="form-control mb-6">

                    <label class="label cursor-pointer justify-start gap-3">

                        <input type="checkbox" name="remember" class="checkbox checkbox-primary">

                        <span class="label-text">
                            Remember me
                        </span>

                    </label>

                </div>

                <button class="btn btn-primary w-full">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Sign In

                </button>

            </form>

        </div>

    </div>

</body>

</html>
