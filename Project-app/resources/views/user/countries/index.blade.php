<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        .country-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .country-item img {
            width: 40px; /* Adjust size as needed */
            height: auto;
            margin-right: 10px;
        }
    </style>
    <title>Countries</title>
</head>
<body>
@include('layouts.navigation')
    <div class="container">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Countries</h2>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <ul>
                                    @foreach($countries as $country)
                                        <li class="country-item">
                                            <img src="{{ $country->flag }}">
                                            <a href="{{ route('countries.show', $country->id) }}">{{ $country->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
