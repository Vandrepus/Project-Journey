<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Support Ticket</title>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Create a New Support Ticket</h1>

            <form action="{{ route('support.store') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Subject -->
                <div class="form-control">
                    <label for="subject" class="label">
                        <span class="label-text font-medium">Subject</span>
                    </label>
                    <input
                        type="text"
                        name="subject"
                        id="subject"
                        class="input input-bordered w-full"
                        placeholder="Enter the ticket subject"
                        required
                    />
                </div>

                <!-- Category -->
                <div class="form-control">
                    <label for="category" class="label">
                        <span class="label-text font-medium">Category</span>
                    </label>
                    <select
                        name="category"
                        id="category"
                        class="select select-bordered w-full"
                        required
                    >
                        <option disabled selected>Select a category</option>
                        <option value="technical">Technical</option>
                        <option value="billing">Billing</option>
                        <option value="general">General</option>
                    </select>
                </div>

                <!-- Message -->
                <div class="form-control">
                    <label for="message" class="label">
                        <span class="label-text font-medium">Message</span>
                    </label>
                    <textarea
                        name="message"
                        id="message"
                        rows="6"
                        class="textarea textarea-bordered w-full"
                        placeholder="Describe your issue or query..."
                        required
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="btn btn-primary w-full md:w-auto px-6 py-3"
                    >
                        <i class="fa-solid fa-paper-plane mr-2"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
    </footer>
</body>
</html>
