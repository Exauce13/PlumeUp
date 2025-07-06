<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#menu-toggle').click(function () {
                $('#mobile-menu').toggleClass('hidden');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-black">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
            <nav class="bg-white bg-opacity-90 fixed w-full z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo et nom -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto opacity-60">
                        </div>
                        <div class="flex items-center ml-2">
                            <a href="#" class="text-xl font-bold text-plume-yellow">PlumeUP</a>
                        </div>
                        
                        <!-- Menu de navigation pour desktop -->
                        <div class="hidden md:block ml-10">
                            <div class="flex items-center space-x-6">
                                <a href="{{ route('accueil') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Accueil</a>
                                <a href="{{ route('actions') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Histoires</a>
                                <a href="{{ route('listesd') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Discussion</a>
                                @if(auth()->user()->statut == 'auteur')
                                <a href="{{ route('pghistoires') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Mes histoires</a>
                                <a href="{{ route('catalogues') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Catalogue</a>
                                @endif
                                @if(auth()->user()->statut == 'SuperAdmin')
                                <a href="{{ route('yes') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">PgAdmin</a>
                                @endif
                                <a href="{{ route('profiles') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Profil</a>
                                <a href="#" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">À propos</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profil utilisateur -->
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('storage/'. Auth::user()->avatar)}}" alt="" class="rounded-full w-7 h-7 object-cover">
                        <p class="font-bold text-plume-yellow">{{ Auth::user()->name }}</p>
                    </div>
                    
                    <!-- Bouton du menu mobile -->
                    <div class="md:hidden">
                        <button type="button" id="menu-toggle" class="bg-white inline-flex items-center justify-center p-2 rounded-md hover:bg-gray-100 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Menu mobile -->
                <div id="mobile-menu" class="md:hidden hidden">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 flex flex-col">
                        <a href="{{ route('accueil') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Accueil</a>
                        <a href="{{ route('actions') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Histoires</a>
                        <a href="{{ route('listesd') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Discussion</a>
                         @if(auth()->user()->statut == 'auteur')
                        <a href="{{ route('pghistoires') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Mes histoires</a>
                        <a href="{{ route('catalogues') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Catalogue</a>
                        @endif
                        @if(auth()->user()->statut == 'SuperAdmin')
                        <a href="{{ route('yes') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">PgAdmin</a>
                        @endif
                        <a href="{{ route('profiles') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Contacts</a>
                        <a href="{{ route('deconnexion') }}" class="bg-red-600 text-white mt-2 px-4 py-2 rounded text-center hover:bg-red-700 transition">Déconnexion</a>
                    </div>
                </div>
            </div>      
        </nav>

    <!-- Navigation Bar -->
                
    <!-- Profile Section -->
    <section class="pt-24 flex justify-center">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-xl p-6">
            <div class="text-center mb-6">
                <img src="{{ asset('storage/'. Auth::user()->avatar)}}" class="w-32 h-32 rounded-full border-4 border-yellow-300 mx-auto object-cover" alt="Profile">
                <h2 class="mt-4 text-2xl font-bold">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">Statut: {{ Auth::user()->statut }}</p>
            </div>
            <form action="{{ route('photo') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <label class="block">
                    <span class="text-gray-700">Image de profil</span>
                    <input type="file" name="avatar" accept="image/*" class="mt-1 block w-full border rounded p-2">
                </label>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Mettre à jour
                </button>
            </form>
        </div>
    </section>
    <!-- Users List -->
<section class="py-12 px-4 max-w-6xl mx-auto">
    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Discussions</h3>

    <p class="text-gray-600 mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow-sm">
        💬 Le système de discussion est exclusivement destiné aux échanges constructifs autour des œuvres publiées sur la plateforme PlumeUP. 
        Nous encourageons des conversations respectueuses et enrichissantes autour de la lecture, de l'écriture et de l'imaginaire.
    </p>

    <!-- Barre de recherche -->
    <form action="{{ route('susers') }}" method="GET" class="mb-6">
        <div class="flex items-center space-x-2">
            <input type="text" name="query" placeholder="Rechercher un utilisateur..." class="flex-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 shadow-sm">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                <i class="fas fa-search mr-1"></i> Rechercher
            </button>
        </div>
    </form>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody>
                @forelse($utilisateurs as $user)
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
</section>
</body>
</html>