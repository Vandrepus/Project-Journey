<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- DaisyUI CDN -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Latest News Articles - JourneyHub</title>
</head>
<body class="bg-base-200 min-h-screen flex flex-col">
  @include('layouts.navigation')

  <!-- Main Content -->
  <main class="flex-grow container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-center mb-8">Latest News Articles</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($articles as $article)
        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
          <div class="card-body flex flex-col">
            <h2 class="card-title line-clamp-2" title="{{ $article->title }}">{{ $article->title }}</h2>
            <p class="line-clamp-3 mt-2 text-gray-600">{{ $article->content }}</p>
            <div class="mt-auto pt-4">
              <p class="text-sm text-gray-500">Comments: {{ $article->comments->count() }}</p>
            </div>
          </div>
          <div class="card-actions justify-center border-t p-4">
            <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">
              Read More
            </a>
          </div>
        </div>
      @empty
        <p class="text-center text-gray-500 col-span-full">No articles available at the moment.</p>
      @endforelse
    </div>

    <!-- Pagination -->
    @if ($articles->hasPages())
      <div class="mt-8">
        {{ $articles->links('pagination::tailwind') }}
      </div>
    @endif
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-6 mt-8">
    <p class="text-sm">&copy; {{ date('Y') }} JourneyHub. All rights reserved.</p>
  </footer>
</body>
</html>
