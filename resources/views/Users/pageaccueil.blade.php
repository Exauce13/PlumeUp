<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PlumeUP - Plateforme de lecture et d'écriture</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <script>
            // Configuration de Tailwind avec des couleurs personnalisées
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            plume: {
                                yellow: '#EAB308',
                                orange: '#F97316',
                                dark: '#1F2937'
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-white text-black">
        <!-- Navigation -->
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
                        <a href="{{ route('profiles') }}" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Profil</a>
                        <a href="{{ route('deconnexion') }}" class="bg-red-600 text-white mt-2 px-4 py-2 rounded text-center hover:bg-red-700 transition">Déconnexion</a>
                    </div>
                </div>
        </div>
            </div>      
        </nav>

        <!-- Hero Section avec image de fond -->
        <section class="relative h-screen flex justify-center items-center">
            <!-- Image de fond avec overlay -->
            <div class="absolute inset-0 bg-cover bg-center bg-fixed bg-[url('/images/open-book-with-natural-element.jpg')]  bg-no-repeat"></div>
            <div class="absolute inset-0 bg-black opacity-50"></div>
            
            <!-- Contenu du hero -->
            <div class="relative text-center p-6 max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 text-plume-yellow">PlumeUp</h1>
                <p class="text-lg md:text-2xl mb-8 text-white font-medium">
                    Bienvenue sur PlumeUP.<br/>
                    L'univers des jeunes auteurs en un clic.
                </p>
                <!--<a href="#" class="bg-blue-700 text-xl text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-150 inline-block shadow-lg">
                    Connectez-vous à PlumeUp
                </a>-->
            </div>
        </section>

        <!-- Section de présentation -->
        <section class="py-12 px-6 max-w-6xl mx-auto">
            <p class="text-xl md:text-2xl text-center text-plume-yellow leading-relaxed">
                PlumeUp est une plateforme numérique innovante dédiée à la lecture, à la découverte de nouveaux talents et à la publication d'œuvres originales. Elle offre aux passionnés de littérature un accès gratuit à une grande diversité de contenus tels que des histoires courtes, romans, poèmes, contes, bandes dessinées et récits éducatifs, couvrant des genres variés comme l'amour, l'aventure, l'horreur, le drame ou encore la réflexion. Les lecteurs bénéficient d'une interface simple, immersive et sans publicité intrusive, leur permettant de plonger pleinement dans chaque univers.
            </p>
        </section>

        <!-- Section des catégories -->
        <section class="py-12 bg-gray-50">
            <h2 class="text-plume-orange text-4xl md:text-5xl text-center mb-12 font-bold">Nos Histoires</h2>
            
            <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Catégorie Aventure & Action -->
                <a href="#" class="group">
                    <div class="bg-white border-plume-yellow border-2 rounded-2xl shadow-md hover:bg-orange-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex justify-center pt-4">
                            <div class="w-[200px] h-[200px] overflow-hidden rounded-full">
                                <img src="{{ asset('images/world-book-day-celebration.jpg') }}" alt="Aventure" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-2xl font-bold mb-4 text-plume-yellow group-hover:text-white">Aventure & Action</h3>
                            <p class="text-gray-700 group-hover:text-white line-clamp-3">Ces histoires sont des récits de quêtes, d'explorations et de défis pleins de rebondissements.</p>
                        </div>
                    </div>
                </a>
                
                <!-- Catégorie Romance -->
                <a href="#" class="group">
                    <div class="bg-white border-plume-yellow border-2 rounded-2xl shadow-md hover:bg-pink-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex justify-center pt-4">
                            <div class="w-[200px] h-[200px] overflow-hidden rounded-full">
                                <img src="{{ asset('images/pexels-shubham-sharma-1420648-2912692.jpg') }}" alt="Romance" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-2xl font-bold mb-4 text-plume-yellow group-hover:text-white">Romance</h3>
                            <p class="text-gray-700 group-hover:text-white line-clamp-3">Sur PlumeUp, les histoires de romance font vibrer les lecteurs à travers des récits d'amour sincères et émouvants.</p>
                        </div>
                    </div>
                </a>
                
                <!-- Catégorie Fantastique & Fantasy -->
                <a href="#" class="group">
                    <div class="bg-white border-plume-yellow border-2 rounded-2xl shadow-md hover:bg-purple-400 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex justify-center pt-4">
                            <div class="w-[200px] h-[200px] overflow-hidden rounded-full">
                                <img src="{{ asset('images/portrait-d-un-enfant-avec-un-dragon-de-fantaisie.jpg') }}" alt="Fantasy" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-2xl font-bold mb-4 text-plume-yellow group-hover:text-white">Fantastique & Fantasy</h3>
                            <p class="text-gray-700 group-hover:text-white line-clamp-3">Univers magiques, créatures imaginaires, pouvoirs surnaturels.</p>
                        </div>
                    </div>
                </a>
                
                <!-- Catégorie Science-Fiction -->
                <a href="#" class="group">
                    <div class="bg-white border-plume-yellow border-2 rounded-2xl shadow-md hover:bg-blue-900 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex justify-center pt-4">
                            <div class="w-[200px] h-[200px] overflow-hidden rounded-full">
                                <img src="{{ asset('images/des-voyages-spatiaux-retro-futuristes.jpg') }}" alt="Science-Fiction" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-2xl font-bold mb-4 text-plume-yellow group-hover:text-white">Science-Fiction</h3>
                            <p class="text-gray-700 group-hover:text-white line-clamp-3">Nos histoires de science fiction vous feront voyager dans des mondes futuristes.</p>
                        </div>
                    </div>
                </a>
                
                <!-- Catégories additionnelles peuvent être ajoutées ici suivant le même modèle -->
            </div>
            
            <!-- Bouton pour voir plus de catégories-->
            <div class="text-center mt-8">
                <a href="{{route('actions')}}" class="inline-block px-8 py-3 bg-plume-yellow text-black font-bold rounded-lg hover:bg-yellow-500 transition duration-150">
                    Voir toutes les catégories
                </a>
            </div>
        </section>

        <!-- Section des features avec images et textes -->
        <section class="py-16 px-6 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Feature 1 -->
                <div class="flex justify-center items-center">
                    <img src="{{ asset('images/seven-shooter-hPKTYwJ4FUo-unsplash.jpg') }}" class="rounded-lg shadow-lg max-w-full h-auto" alt="Lecture diversifiée">
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-plume-orange mb-4">Une expérience de lecture diversifiée</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        PlumeUP permet aux utilisateurs de lire une grande variété d'œuvres : romans, poèmes, contes, BD, etc.
                        Ils peuvent naviguer par genre, popularité ou nouveauté. Chaque lecture est accompagnée d'un résumé et
                        d'une belle présentation. L'expérience est fluide sur tous les supports (mobile, tablette, PC). 
                        Des recommandations personnalisées aident à découvrir de nouveaux talents.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="flex flex-col justify-center md:order-3">
                    <h3 class="text-2xl font-bold text-plume-orange mb-4">Un espace pour tous les auteurs</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Les auteurs peuvent publier facilement leurs textes, qu'ils soient complets ou en épisodes. Ils ajoutent des résumés, des images et des tags pour plus de visibilité. La plateforme accepte tous les styles : récits, poèmes, BD, contes, etc. Les auteurs gardent le contrôle total de leurs œuvres. C'est un espace idéal pour débuter, partager et progresser.
                    </p>
                </div>
                <div class="flex justify-center items-center md:order-4">
                    <img src="{{ asset('images/markus-winkler-H8SQHzxVk-A-unsplash.jpg') }}" class="rounded-lg shadow-lg max-w-full h-auto" alt="Espace auteurs">
                </div>
                
                <!-- Feature 3 -->
                <div class="flex justify-center items-center">
                    <img src="{{ asset('images/ben-sweet-2LowviVHZ-E-unsplash.jpg') }}" class="rounded-lg shadow-lg max-w-full h-auto" alt="Communauté littéraire">
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-plume-orange mb-4">Une communauté littéraire active</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Lecteurs et auteurs échangent librement via les commentaires sous chaque œuvre ou la création de groupes entre passionnés de lecture pour discuter et échanger. Cela permet de donner son avis, encourager ou poser des questions. Les auteurs reçoivent des retours utiles pour s'améliorer. Les échanges renforcent la communauté autour de l'écriture. 
                    </p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Colonne logo et tagline -->
                <div>
                    <h2 class="text-3xl font-bold text-plume-yellow mb-4">PlumeUp</h2>
                    <p class="text-gray-400">L'univers des jeunes auteurs en un clic.</p>
                </div>
                
                <!-- Colonne contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-plume-yellow">Contact</h3>
                    <p class="text-gray-400 mb-2">Pays : Bénin</p>
                    <p class="text-gray-400 mb-2">Email : contact@plumeup.com</p>
                    <p class="text-gray-400">Téléphone : +229 40 42 30 21</p>
                </div>
                
                <!-- Colonne navigation -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-plume-yellow">Navigation</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-plume-yellow transition">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-plume-yellow transition">Catalogue</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-plume-yellow transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-plume-yellow transition">Contacts</a></li>
                    </ul>
                </div>
                
                <!-- Colonne CTA -->
                <div class="flex flex-col gap-4">
                    <a href="#" class="px-4 py-2 bg-plume-yellow text-black font-semibold rounded hover:bg-yellow-500 transition text-center">Inscription</a>
                    <a href="#" class="px-4 py-2 border border-plume-yellow text-plume-yellow font-semibold rounded hover:bg-plume-yellow hover:text-black transition text-center">Connexion</a>
                    <a href="{{ route('deconnexion') }}" class="px-4 py-2 bg-green-600 text-white text-center rounded hover:bg-red-600 transition">Déconnexion</a>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="mt-12 text-center text-gray-500 text-sm">
                © 2025 PlumeUp — Tous droits réservés.
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            // Toggle menu mobile
            document.getElementById('menu-toggle').addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        </script>
    </body> 
</html>