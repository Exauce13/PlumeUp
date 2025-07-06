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
    <body class="bg-gray-50">
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

            <!-- Navbar des catégories -->
            <nav class="category-nav fixed w-full z-10 mt-16 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 py-3">
                    <div class="categories-scroll">
                        <div class="flex space-x-12 min-w-max">
                            <a href="{{ route('actions') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap bg-white bg-opacity-20 font-semibold">
                                <i class="fas fa-sword mr-2"></i>Aventure & Action
                            </a>
                            <a href="{{ route('romance') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-heart mr-2"></i>Romance
                            </a>
                            <a href="{{ route('fantasy') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-dragon mr-2"></i>Fantastique & Fantasy
                            </a>
                            <a href="{{ route('sciences') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-rocket mr-2"></i>Science-Fiction
                            </a>
                            <a href="{{ route('suspences') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-ghost mr-2"></i>Horreur & Suspense
                            </a>
                            <a href="{{ route('mystères') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-search mr-2"></i>Policier & Mystère
                            </a>
                            <a href="{{ route('realismes') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-theater-masks mr-2"></i>Drame & Réalisme
                            </a>
                            <a href="{{ route('historiques') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-landmark mr-2"></i>Historique
                            </a>
                            <a href="{{ route('jeunesses') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-child mr-2"></i>Jeunesse & Contes
                            </a>
                            <a href="{{ route('courtextes') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-feather mr-2"></i>Poèmes & Textes courts
                            </a>
                            <a href="{{ route('webtoon') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-images mr-2"></i>Bande dessinée & Webtoon
                            </a>
                            <a href="{{ route('univers') }}" class="category-link text-white px-4 py-2 text-sm whitespace-nowrap">
                                <i class="fas fa-users mr-2"></i>Fanfiction & Univers dérivés
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Contenu principal avec espacement pour les deux navbars -->
        <div class="pt-32 pb-8">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-8 text-indigo-800">Histoires - Aventure & Action</h2>
                
                @if($history->isEmpty())
                    <div class="text-center py-12 bg-white rounded-lg shadow max-w-md mx-auto">
                        <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-xl text-gray-600">Aucune histoire trouvée pour ce type.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-items-center">
                        @foreach($history as $histoire)
                            <div class="book-card bg-white rounded-xl overflow-hidden shadow-md w-full max-w-xs">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/'. $histoire->photos) }}" alt="{{ $histoire->titre_book }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2 truncate" title="{{ $histoire->titre_book }}">{{ $histoire->titre_book }}</h3>
                                    <span class="inline-block bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs mb-3">Type : {{ $histoire->type_book }}</span>
                                    <span class="inline-block bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs mb-3">Auteur : {{ $histoire->user->name }}</span>
                                    <div class="space-y-3">
                                        <div class="flex justify-center space-x-4">
                                            <form action="{{ route('like', $histoire->id) }}" method="POST">
                                                @csrf
                                                @method('post')
                                                <button type="submit" class="interaction-icon flex items-center text-gray-600 text-sm">
                                                    <i class="fas fa-heart mr-1"></i>
                                                    <span>{{ $histoire->likes->count() }}</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('dislike', $histoire->id) }}" method="POST">
                                                @csrf
                                                @method('post')
                                                <button class="interaction-icon flex items-center text-gray-600 text-sm">
                                                    <i class="fas fa-thumbs-down mr-1"></i>
                                                    <span>{{ $histoire->dislikes->count() }}</span>
                                                </button>
                                            </form>
                                            <a href="{{ route('pgcommentaire', $histoire->id) }}">
                                                <span class="interaction-icon flex items-center text-gray-600 text-sm">
                                                    <i class="fas fa-comment mr-1"></i>
                                                    <span>{{ $histoire->commentaires->count() }}</span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex space-x-2">
                                            @if($histoire->modediffusion == 'Par chapitres ou tomes' && $histoire->type_book == 'Bande dessinée & Webtoon')
                                            <a href="{{ route('vue', $histoire->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                                <i class="fas fa-eye mr-1"></i> Voir
                                            </a>
                                            @elseif($histoire->modediffusion == 'Par chapitres ou tomes')
                                            <a href="{{ route('chap', $histoire->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                                <i class="fas fa-eye mr-1"></i> Voir
                                            </a>
                                            @else
                                            <a href="{{ asset('storage/' . $histoire->url_book) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                                <i class="fas fa-eye mr-1"></i> Voir
                                            </a>
                                            @endif

                                            <a href="{{asset('storage/' . $histoire->url_book)}}" download 
                                               class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-xs flex-1 text-center">
                                                <i class="fas fa-download mr-1"></i> Télécharger
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Section Logo et Description -->
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto opacity-80">
                            <h3 class="text-2xl font-bold text-plume-yellow ml-2">PlumeUP</h3>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Votre plateforme dédiée à la lecture et à l'écriture. Découvrez des histoires captivantes et partagez vos propres créations avec une communauté passionnée.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                                <i class="fab fa-discord text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Section Navigation -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-white">Navigation</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('accueil') }}" class="text-gray-300 hover:text-white transition duration-300 text-sm">Accueil</a></li>
                            <li><a href="{{ route('actions') }}" class="text-gray-300 hover:text-white transition duration-300 text-sm">Histoires</a></li>
                            <li><a href="{{ route('profiles') }}" class="text-gray-300 hover:text-white transition duration-300 text-sm">Profil</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">À propos</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Section Catégories -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-white">Catégories Populaires</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Aventure & Action</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Romance</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Fantastique & Fantasy</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Science-Fiction</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Horreur & Suspense</a></li>
                        </ul>
                    </div>

                    <!-- Section Support et Légal -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-white">Support & Légal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Centre d'aide</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Conditions d'utilisation</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Politique de confidentialité</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Droits d'auteur</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-300 text-sm">Nous contacter</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Ligne de séparation -->
                <div class="border-t border-gray-700 mt-8 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-400 text-sm">
                            © 2024 PlumeUP. Tous droits réservés.
                        </p>
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <span class="text-gray-400 text-sm">Fait avec</span>
                            <i class="fas fa-heart text-red-500"></i>
                            <span class="text-gray-400 text-sm">pour les amoureux des livres</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
                <script>
            // Toggle menu mobile
            document.getElementById('menu-toggle').addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        </script>
    </body>
</html>