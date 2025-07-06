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

  <!-- Main content -->
  <main class="flex-1 p-8 bg-gray-50 min-h-screen flex flex-col">
    <div class="bg-white rounded-xl shadow-md p-6 flex-grow">
      <h2 class="text-3xl font-bold mb-6 text-indigo-700">Liste utilisateurs</h2>
      <form action="{{ route('shistoire') }}" method="GET" class="flex">
        <input type="text" name="query" placeholder="Rechercher un utilisateur..." class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64" />
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700"><i class="fas fa-search"></i>Rechercher</button>
      </form>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody>
                @forelse($histoires as $histoire)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center">
                        <img src="{{ asset('storage/'.$histoire->photo) }}" class="w-10 h-10 rounded-full mr-3 object-cover" alt="Avatar">
                        <div>
                            <div class="font-semibold text-gray-900">{{ $histoire->titre_book }}</div>
                            <div class="text-sm text-gray-500">{{ $histoire->type_book }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex space-x-2">
                            @if($histoire->modediffusion == 'Par chapitres ou tomes')
                            <a href="{{route('chap', $histoire->id)}}"  class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </a>
                            @else
                            <a href="{{ asset('storage/' . $histoire->url_book) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </a>
                            @endif
                            <a href="{{asset('storage/' . $histoire->url_book)}}" download class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                <i class="fas fa-download mr-1"></i> Télécharger
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-500">Aucun histoire trouvé.</td>
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
