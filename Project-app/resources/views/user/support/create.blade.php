<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Support Ticket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Create a New Support Ticket</h1>

            <form action="{{ route('support.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" name="subject" id="subject" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="technical">Technical</option>
                        <option value="billing">Billing</option>
                        <option value="general">General</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" id="message" rows="6" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Submit
                </button>
            </form>
        </div>
    </div>
</body>
</html>
