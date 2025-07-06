<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            .book-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .book-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }
            .interaction-icon {
                transition: color 0.2s ease;
            }
            .interaction-icon:hover {
                color: #4F46E5;
            }
            .category-nav {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .category-link {
                transition: all 0.3s ease;
                border-radius: 25px;
            }
            .category-link:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateY(-2px);
            }
            .categories-scroll {
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            .categories-scroll::-webkit-scrollbar {
                display: none;
            }
        </style>
    </head>
    <body class="bg-gray-50 bg-black">
        <header>
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
    </header>
    <div class="flex flex-col items-center">
    <div class="w-full max-w-md px-4 pt-6">
        <h1 class="text-xl font-bold mb-6 text-center">Images liées à l'histoire</h1>

        <div class="flex flex-col items-center space-y-0">
            @forelse($images as $img)
                <div class="w-full mb-0">
                    <img src="{{ asset('storage/'. $img) }}" alt="Image" class="w-full h-auto object-cover rounded shadow">
                </div>
            @empty
                <p class="text-center">Aucune image disponible pour cette histoire.</p>
            @endforelse
        </div>
        <div class="mt-8 flex justify-center">
            <a href="{{ route('imgchap', $histoire->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm text-center shadow transition">
                <i class="fas fa-eye mr-1"></i> Voir les autres châpitres
            </a>
        </div>
    </div>
</div>

</body>
</html>
