<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Commentaires de l'histoire</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-lg h-screen fixed top-0 left-0 flex flex-col">
    <div class="px-6 py-4 border-b border-gray-200">
      <h1 class="text-2xl font-bold text-indigo-700">PlumeUP Admin</h1>
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('yes') }}" class="flex items-center px-3 py-2 rounded hover:bg-indigo-100 text-gray-700">
        <i class="fas fa-home mr-3 text-indigo-600"></i> Tableau de bord
      </a>
      <a href="{{ route('listes') }}" class="flex items-center px-3 py-2 rounded hover:bg-indigo-100 text-gray-700">
        <i class="fas fa-book mr-3 text-indigo-600"></i> Gestion des histoires
      </a>
      <a href="{{ route('lusers') }}" class="flex items-center px-3 py-2 rounded hover:bg-indigo-100 text-gray-700">
        <i class="fas fa-users mr-3"></i> Gestion des utilisateurs
      </a>
    </nav>
    <div class="p-4 text-sm text-center text-gray-400 border-t border-gray-100">
      &copy; {{ date('Y') }} PlumeUp
    </div>
  </aside>

  <!-- Contenu principal -->
  <div class="ml-64 flex-1 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-md py-4 px-8">
      <h1 class="text-2xl font-bold text-indigo-700">Commentaires</h1>
      <p class="text-sm text-gray-600">Tous les commentaires liés à cette histoire</p>
    </header>

    <!-- Section des commentaires -->
    <main class="flex-grow">
      <div class="max-w-4xl mx-auto py-8 px-4">
        @forelse($comment as $com)
          <div class="bg-white rounded-xl shadow p-4 mb-4">
            <div class="flex items-center justify-between mb-2">
              <span class="font-semibold text-blue-600">{{ $com->user->name }}</span>
              <span class="text-sm text-gray-500">{{ $com->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <p class="text-gray-700">{{ $com->comment }}</p>
          </div>
        @empty
          <div class="text-center text-gray-500">
            Aucun commentaire pour le moment.
          </div>
        @endforelse
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner py-4">
      <div class="max-w-6xl mx-auto px-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} PlumeUp — Tous droits réservés.
      </div>
    </footer>
  </div>

</body>
</html>
