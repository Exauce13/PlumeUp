<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Liste des histoires</title>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-lg h-screen sticky top-0 flex flex-col">
    <div class="p-6 border-b border-gray-200">
      <h1 class="text-2xl font-bold text-indigo-600">PlumeUp Admin</h1>
    </div>
    <nav class="flex-1 p-4 space-y-4 text-sm">
      <a href="{{ route('yes') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-indigo-100 text-indigo-700 font-medium">
        <i class="fas fa-chart-line mr-3"></i> Tableau de bord
      </a>
    </nav>
    <div class="p-4 border-t border-gray-200 text-xs text-gray-500 text-center">
      &copy; {{ date('Y') }} PlumeUp
    </div>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8 bg-gray-50 min-h-screen flex flex-col">
    <div class="bg-white rounded-xl shadow-md p-6 flex-grow">
      <h2 class="text-3xl font-bold mb-6 text-indigo-700">Liste des Histoires</h2>
      <form action="{{ route('livres') }}" method="GET" class="flex">
        <input type="text" name="query" placeholder="Rechercher un utilisateur..." class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64" />
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700"><i class="fas fa-search"></i>Rechercher</button>
      </form>

      <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-indigo-100 text-indigo-800">
            <tr>
              <th class="px-6 py-3 text-left font-semibold uppercase">Livre</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Auteur</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Type</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Photo</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Diffusion</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Likes</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Dislikes</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Commentaires</th>
              <th class="px-6 py-3 text-left font-semibold uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-100">
            @forelse($histoires as $historia)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fa-solid fa-book-open text-indigo-600"></i>
                  </div>
                  <div class="font-medium text-gray-900">{{ $historia->titre_book }}</div>
                </div>
              </td>
              <td class="px-6 py-4">{{ $historia->user->name }}</td>
              <td class="px-6 py-4">{{ $historia->type_book }}</td>
              <td class="px-6 py-4">
                <img src="{{ asset('storage/'. $historia->photos) }}" alt="Photo" class="w-12 h-12 rounded-md object-cover">
              </td>
              <td class="px-6 py-4">
                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                  {{ $historia->modediffusion }}
                </span>
              </td>
              <td class="px-6 py-4">{{ $historia->likes->count() }}</td>
              <td class="px-6 py-4">{{ $historia->dislikes->count() }}</td>
              <td class="px-6 py-4">{{ $historia->commentaires->count() }}</td>
              <td class="px-6 py-4">
                <div class="flex items-center space-x-2">
                  @if($historia->modediffusion == 'Par chapitres ou tomes')
                  <a href="{{ route('chap', $historia->id) }}" class="flex items-center px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-xs" title="Voir l'histoire">
                    <i class="fas fa-eye mr-1"></i> Voir
                  </a>
                  @else
                  <a href="{{ asset('storage/' . $historia->url_book) }}" target="_blank" class="flex items-center px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-xs" title="Voir le fichier">
                    <i class="fas fa-eye mr-1"></i> Voir
                  </a>
                  @endif
                  <a href="{{ route('affichecommentaire', $historia->id) }}" class="flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 text-xs" title="Commentaires">
                    <i class="fa-solid fa-comment"></i>
                  </a>
                  <form action="{{ route('suppression', $historia->id) }}" method="POST" class="inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="flex items-center px-2 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 text-xs" title="Supprimer">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9" class="text-center py-6 text-gray-500">Aucune histoire trouvée.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 text-center text-gray-500 text-sm">
      &copy; {{ date('Y') }} PlumeUp. Tous droits réservés.
    </footer>
  </main>

</body>
</html>
