<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Movie Finder</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #0f172a;
    }
    ::placeholder {
      color: #94a3b8;
    }
    .glass {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
    }
  </style>
</head>
<body class="text-white font-sans leading-relaxed">

  <!-- ✅ Navbar -->
  <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-slate-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <a href="/" class="text-2xl font-bold text-white hover:text-blue-400 transition duration-300">
          🎥 Movie Finder
        </a>
      </div>
    </div>
  </nav>
