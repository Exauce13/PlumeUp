<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Liste des utilisateurs</title>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">
  <!-- Main content -->
  <main class="flex-1 p-8 bg-gray-50 min-h-screen flex flex-col">
    <div class="bg-white rounded-xl shadow-md p-6 flex-grow">
      <h2 class="text-3xl font-bold mb-6 text-indigo-700">Liste des Histoires</h2>
      <form action="{{ route('susers') }}" method="GET" class="flex">
        <input type="text" name="query" placeholder="Rechercher un utilisateur..." class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64" />
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700"><i class="fas fa-search"></i>Rechercher</button>
      </form>
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody>
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center">
                        <img src="{{ asset('storage/'.$user->avatar) }}" class="w-10 h-10 rounded-full mr-3 object-cover" alt="Avatar">
                        <div>
                            <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $user->pseudo }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $user->statut === '' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->statut ?: 'Actif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('futurpotes', $user->id) }}" class="text-indigo-600 hover:underline text-sm">
                            <i class="fas fa-comments mr-1"></i> Discussion
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-500">Aucun utilisateur trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Footer -->
    <footer class="mt-8 text-center text-gray-500 text-sm">
      &copy; {{ date('Y') }} PlumeUp. Tous droits réservés.
    </footer>
  </main>

</body>
</html>
