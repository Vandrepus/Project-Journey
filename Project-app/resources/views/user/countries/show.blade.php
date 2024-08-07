<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $country->name }}</title>
    <style>
        body {
            font-family: 'figtree', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .bg-white {
            background-color: #ffffff;
        }
        .shadow-sm {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .sm\:rounded-lg {
            border-radius: 0.375rem;
        }
        .text-gray-800 {
            color: #2d3748;
        }
        .text-xl {
            font-size: 1.25rem;
        }
        .font-semibold {
            font-weight: 600;
        }
        .leading-tight {
            line-height: 1.25;
        }
        .py-12 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .max-w-7xl {
            max-width: 80rem;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }
        .p-6 {
            padding: 1.5rem;
        }
        .text-gray-900 {
            color: #4a5568;
        }
        .list-disc {
            list-style-type: disc;
            margin-left: 1.5rem;
        }
    </style>
</head>
<body>
@include('layouts.navigation')

    <div class="container py-12">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ $country->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $country->description }}</p>

            <h2 class="text-xl font-semibold text-gray-800 mb-4">Sights</h2>
            <ul class="list-disc pl-5">
                @foreach($sights as $sight)
                    <li class="mb-2">
                        <a href="{{ route('sights.show', $sight->id) }}" class="text-blue-500 hover:underline">{{ $sight->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
