<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Discussions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto opacity-70">
                    <a href="#" class="text-xl font-semibold text-yellow-500">PlumeUP</a>

                    <div class="hidden md:flex gap-6 ml-8">
                        <a href="{{ route('accueil') }}" class="text-gray-700 hover:text-blue-600 transition">Accueil</a>
                        <a href="{{ route('actions') }}" class="text-gray-700 hover:text-blue-600 transition">Histoires</a>
                        <a href="{{ route('listesd') }}" class="text-blue-700 font-medium underline">Discussion</a>
                        @if(auth()->user()->statut == 'auteur')
                            <a href="{{ route('pghistoires') }}" class="text-gray-700 hover:text-blue-600 transition">Mes histoires</a>
                            <a href="{{ route('catalogues') }}" class="text-gray-700 hover:text-blue-600 transition">Catalogue</a>
                        @endif
                        @if(auth()->user()->statut == 'SuperAdmin')
                            <a href="{{ route('yes') }}" class="text-gray-700 hover:text-blue-600 transition">PgAdmin</a>
                        @endif
                        <a href="{{ route('profiles') }}" class="text-gray-700 hover:text-blue-600 transition">Profil</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition">À propos</a>
                    </div>
                </div>

                <!-- User -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('storage/'. Auth::user()->avatar)}}" alt="Avatar" class="w-8 h-8 rounded-full object-cover ring-2 ring-yellow-400">
                    <span class="text-sm font-bold text-yellow-600">{{ Auth::user()->name }}</span>
                </div>

                <!-- Menu Mobile -->
                <div class="md:hidden">
                    <button id="menu-toggle" class="p-2 rounded hover:bg-gray-200">
                        <i class="fas fa-bars text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Menu mobile -->
            <div id="mobile-menu" class="hidden md:hidden py-3">
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('accueil') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Accueil</a>
                    <a href="{{ route('actions') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Histoires</a>
                    <a href="{{ route('listesd') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Discussion</a>
                    @if(auth()->user()->statut == 'auteur')
                    <a href="{{ route('pghistoires') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Mes histoires</a>
                    <a href="{{ route('catalogues') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Catalogues</a>
                    @endif
                    @if(auth()->user()->statut == 'SuperAdmin')
                    <a href="{{ route('yes') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Admin</a>
                    @endif
                    <a href="{{ route('profiles') }}" class="px-3 py-2 hover:bg-gray-100 rounded">Profil</a>
                    <a href="#" class="px-3 py-2 hover:bg-gray-100 rounded">À propos</a>
                    <a href="#" class="px-3 py-2 hover:bg-gray-100 rounded">Contacts</a>
                    <a href="{{ route('deconnexion') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-fit">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="pt-20 px-4 max-w-6xl mx-auto flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-comments text-blue-600"></i> Mes Discussions
        </h1>
        <a href="{{ route('friendsindex') }}" class="text-sm text-blue-600 hover:underline">Amis</a>
    </header>

    <!-- Main -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Conversations récentes</h2>

        <div class="bg-white shadow rounded-lg divide-y divide-gray-100">
            @forelse($users as $user)
                <a href="{{ route('listemessages', $user->id) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 transition">
                    <div class="relative">
                        <img src="{{ asset('storage/'. $user->avatar)}}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover shadow-md">
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->pseudo ?? 'Pseudo inconnu' }}</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                </a>
            @empty
                <div class="p-10 text-center text-gray-500">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-comments text-2xl text-gray-400"></i>
                    </div>
                    <p class="text-lg font-semibold">RAS</p>
                    <p class="text-sm">Aucune conversation trouvée</p>
                    <a href="#" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i> Démarrer une conversation
                    </a>
                </div>
            @endforelse
        </div>
    </main>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
