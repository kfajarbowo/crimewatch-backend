<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Crime Watch') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Navigation -->
            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <h1 class="text-2xl font-bold text-gray-900">Crime Watch</h1>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <a href="{{ url('login') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                Admin Login
                            </a>
                                </div>
                                </div>
                                </div>
            </nav>

            <!-- Main Content -->
            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div class="mt-10 text-center">
                        <h2 class="text-4xl font-extrabold text-gray-900">
                            Welcome to Crime Watch Admin Panel
                        </h2>
                        <p class="mt-4 text-lg text-gray-500">
                            Please login to access the admin dashboard.
                        </p>
                        <div class="mt-8">
                            <a href="{{ url('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Login to Dashboard
                            </a>
                                </div>
                            </div>
                        </div>
                    </main>
        </div>
    </body>
</html>