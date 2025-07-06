<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Gestion des utilisateurs</title>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

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
      <a href="{{ route('lusers') }}" class="flex items-center px-3 py-2 rounded bg-indigo-100 text-indigo-700 font-semibold">
        <i class="fas fa-users mr-3"></i> Gestion des utilisateurs
      </a>
    </nav>
    <div class="p-4 text-sm text-center text-gray-400 border-t border-gray-100">
      &copy; {{ date('Y') }} PlumeUp
    </div>
  </aside>

<!-- Main content -->
<div class="ml-64 flex-1 p-8">
  <div class="bg-white rounded-xl shadow-lg p-8">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
      <h2 class="text-3xl font-bold text-indigo-700 mb-4 sm:mb-0">Gestion des utilisateurs</h2>
      <form action="{{ route('userec') }}" method="GET" class="flex">
        <input type="text" name="query" placeholder="Rechercher un utilisateur..." class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64" />
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700"><i class="fas fa-search"></i>Rechercher</button>
      </form>
    </div>

    <div class="overflow-x-auto rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-indigo-100 text-indigo-800 text-left">
          <tr>
            <th class="px-6 py-3 font-semibold uppercase">Utilisateur</th>
            <th class="px-6 py-3 font-semibold uppercase">Email</th>
            <th class="px-6 py-3 font-semibold uppercase">Pseudos</th>
            <th class="px-6 py-3 font-semibold uppercase">Inscription</th>
            <th class="px-6 py-3 font-semibold uppercase">Statut</th>
            <th class="px-6 py-3 font-semibold uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          @forelse($utilisateur as $user)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap flex items-center">
              <img src="{{ asset('storage/'.$user->avatar) }}" alt="User" class="w-10 h-10 rounded-full mr-3 object-cover">
              <div>
                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                <div class="text-sm text-gray-500">Lecteur Premium</div>
              </div>
            </td>
            <td class="px-6 py-4">{{ $user->email }}</td>
            <td class="px-6 py-4">{{ $user->pseudo }}</td>
            <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
              {{ $user->statut !== 'suspendu' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $user->statut ?: 'Actif' }}
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center space-x-2">
                <a href="{{ route('info', $user->id) }}" class="text-indigo-600 hover:underline text-sm">Voir</a>

                @if (!$user->is_suspended)
                <form action="{{ route('susp', $user->id) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">Suspendre</button>
                </form>
                @else
                <form action="{{ route('reacte', $user->id) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">Réactiver</button>
                </form>
                @endif

                <form action="{{ route('supprimer', $user->id) }}" method="POST" class="inline">
                  @csrf
                  @method('delete')
                  <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">Supprimer</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-6 text-gray-500">Aucun utilisateur trouvé.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center mt-8 text-gray-500 text-sm">
    &copy; {{ date('Y') }} PlumeUp. Tous droits réservés.
  </footer>
</div>
</body>
</html>