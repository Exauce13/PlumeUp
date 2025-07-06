<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Commentaires</title>
</head>
<body class="bg-gray-100 min-h-screen">
    <header>
            <!-- Navbar principale -->
            <nav class="bg-white bg-opacity-90 fixed w-full z-20 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo et nom -->
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto opacity-60">
                            </div>
                            <div class="flex items-center ml-2">
                                <h2 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-yellow-600 bg-clip-text text-transparent">
                                    PlumeUP
                                </h2>
                            </div>
                            
                            <!-- Menu de navigation pour desktop -->
                            <div class="hidden md:block ml-10">
                                <div class="flex items-center space-x-6">
                                    <a href="{{ route('accueil') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Accueil</a>
                                    <a href="{{ route('actions') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Histoires</a>
                                    @if(auth()->user()->statut == 'auteur')
                                    <a href="{{ route('pghistoires') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Mes histoires</a>
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
                            @if(auth()->user()->statut == 'auteur')
                            <a href="{{ route('pghistoires') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Mes histoires</a>
                            @endif
                            <a href="{{ route('profiles') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Profil</a>
                            <a href="#" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Contacts</a>
                            <a href="{{ route('deconnexion') }}" class="bg-red-600 text-white mt-2 px-4 py-2 rounded text-center hover:bg-red-700 transition">Déconnexion</a>
                        </div>
                    </div>
                </div>      
            </nav>
    </header>

    <!-- Espacement pour la navbar fixe -->
    <div class="pt-16"></div>

    <!-- Image en largeur complète avec titre -->
    <div class="w-full relative bg-gradient-to-b from-black/50 to-black/30">
        <div class="w-full h-64 md:h-80 lg:h-96 overflow-hidden">
            <img src="{{ asset('storage/'. $histoire->photos) }}" alt="{{ $histoire->titre_book }}" class="w-full h-full object-cover">
        </div>
        <!-- Overlay avec titre -->
        <div class="absolute inset-0  bg-opacity-40 flex items-center justify-center">
            <div class="text-center px-4">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 drop-shadow-lg">
                    {{ $histoire->titre_book }}
                </h1>
                <p class="text-xl md:text-2xl text-white/90 drop-shadow-md">
                    <i class="fa-solid fa-comments mr-2"></i>Commentaires
                </p>
            </div>
        </div>
    </div>

    <!-- Section des commentaires -->
    <div class="max-w-4xl mx-auto p-6 -mt-8 relative z-10">
        <!-- Card principale avec bordure arrondie -->
        <div class="bg-white rounded-t-2xl shadow-xl p-6">
            
            <!-- Liste des commentaires principaux -->
            <div class="space-y-6">
                @foreach ($commentaires as $commentaire)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ substr($commentaire->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="font-medium text-gray-900">{{ $commentaire->user->name }}</span>
                                    <span class="text-sm text-gray-500">•</span>
                                    <span class="text-sm text-gray-500">{{ $commentaire->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                                <p class="text-gray-800 leading-relaxed">{{ $commentaire->comment }}</p>
                            </div>
                        </div>

                        <!-- Réponses à ce commentaire -->
                        @foreach ($commentaire->children as $child)
                            <div class="ml-12 mt-4 p-3 bg-white border-l-4 border-blue-300 rounded-r-lg shadow-sm">
                                <div class="flex items-center space-x-2 mb-2">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                        {{ substr($child->user->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-sm text-gray-900">{{ $child->user->name }}</span>
                                    <span class="text-xs text-gray-500">•</span>
                                    <span class="text-xs text-gray-500">{{ $child->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                                <p class="text-sm text-gray-800">{{ $child->contenu }}</p>
                            </div>
                        @endforeach

                        <!-- Formulaire de réponse 
                        <div class="ml-12 mt-4">
                            <form action="{{ route('reponse') }}" method="POST" class="space-y-3">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="histoire_id" value="{{$histoire->id}}">
                                <input type="hidden" name="parent_id" value="{{ $commentaire->id }}">

                                <textarea name="commentaire" rows="2" required
                                          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                          placeholder="Répondre à ce commentaire..."></textarea>

                                <button type="submit"
                                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fa-solid fa-reply"></i>
                                    <span>Répondre</span>
                                </button>
                            </form>
                        </div>-->
                    </div>
                @endforeach
            </div>

            <!-- Formulaire de nouveau commentaire -->
            <div class="mt-10 pt-8 border-t border-gray-200">
                <form action="{{ route('poste') }}" method="POST" class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl shadow-sm border border-blue-200">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="histoire_id" value="{{$histoire->id}}">
                    <input type="hidden" name="parent_id" value="">

                    <div class="flex items-center space-x-3 mb-4">
                        <i class="fa-solid fa-comment-dots text-blue-600 text-xl"></i>
                        <label for="commentaire" class="block text-gray-800 font-semibold text-lg">Ajouter un commentaire</label>
                    </div>
                    
                    <textarea id="commentaire" name="content" rows="4" required
                              class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none shadow-sm"
                              placeholder="Partagez vos pensées sur cette histoire..."></textarea>

                    <button type="submit"
                            class="mt-4 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 flex items-center space-x-2 font-medium shadow-md hover:shadow-lg">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Publier le commentaire</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white mt-12">
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