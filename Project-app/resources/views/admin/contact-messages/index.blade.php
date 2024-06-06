<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Add your custom CSS styles here */
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
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .table th, .table td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }
        .table th {
            background-color: #edf2f7;
            font-weight: bold;
        }
        .table tbody tr:nth-child(even) {
            background-color: #edf2f7;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Contact Messages</h1>

        @if(session('success'))
            <div class="success-message">
                <strong>Success!</strong>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($messages->count() > 0)
                    @foreach ($messages as $message)
                        <tr>
                            <td class="border px-4 py-2">{{ $message->name }}</td>
                            <td class="border px-4 py-2">{{ $message->email }}</td>
                            <td class="border px-4 py-2">{{ $message->subject }}</td>
                            <td class="border px-4 py-2">{{ $message->message }}</td>
                            <td class="border px-4 py-2">{{ $message->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="6">No messages found.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{ $messages->links() }} <!-- Pagination links -->
    </div>
</body>
</html>
