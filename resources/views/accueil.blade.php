<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
        $(document).ready(function () {
            $('#menu-toggle').click(function () {
                $('#mobile-menu').toggleClass('hidden');
            });
        });
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            /* Styles personnalisés pour des améliorations subtiles */
            .hero-gradient {
                background: linear-gradient(135deg, rgba(220, 38, 127, 0.8), rgba(239, 68, 68, 0.6));
            }
            
            .card-hover {
                transition: all 0.3s ease;
            }
            
            .card-hover:hover {
                transform: translateY(-4px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }
            
            .glass-effect {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.85);
            }
            
            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }
            
            .smooth-scroll {
                scroll-behavior: smooth;
            }
            
            /* Animation personnalisée */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-fadeInUp {
                animation: fadeInUp 0.8s ease-out;
            }
        </style>
    </head>
    <body class="smooth-scroll">
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        
        <!-- Navigation améliorée -->
        <nav class="glass-effect fixed w-full z-20 shadow-lg border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto rounded-full">
                        </div>
                        <h4 class="ml-4 text-xl font-bold text-amber-600">PlumeUP</h4>
                        <div class="hidden md:flex mx-10 items-center space-x-8">
                            <a href="#" class="text-gray-700 hover:text-amber-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Accueil</a>
                            <a href="#catalogue" class="text-gray-700 hover:text-amber-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Catalogue</a>
                            <a href="#about" class="text-gray-700 hover:text-amber-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">À propos</a>
                            <a href="#contact" class="text-gray-700 hover:text-amber-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Contacts</a>
                        </div>
                    </div>

                    <!-- Boutons de connexion améliorés -->
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('log') }}" class="text-blue-600 font-medium hover:text-blue-800 transition duration-200">Connexion</a>
                        <a href="{{ route('enregistrer') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-200 shadow-md">Inscription</a>
                    </div>

                    <!-- Menu mobile -->
                    <div class="md:hidden flex items-center">
                        <input type="checkbox" id="menu-toggle" class="hidden peer">
                        <label for="menu-toggle" class="cursor-pointer p-2 rounded-md text-gray-700 hover:bg-gray-100 transition duration-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Menu mobile amélioré -->
            <div class="md:hidden peer-checked:block hidden bg-white border-t border-gray-200" id="mobile-menu">
                <div class="px-4 pt-4 pb-3 space-y-2">
                    <a href="#" class="text-gray-700 hover:text-amber-600 block px-3 py-2 rounded-md text-base font-medium transition duration-200">Accueil</a>
                    <a href="#catalogue" class="text-gray-700 hover:text-amber-600 block px-3 py-2 rounded-md text-base font-medium transition duration-200">Catalogue</a>
                    <a href="#about" class="text-gray-700 hover:text-amber-600 block px-3 py-2 rounded-md text-base font-medium transition duration-200">À propos</a>
                    <a href="#contact" class="text-gray-700 hover:text-amber-600 block px-3 py-2 rounded-md text-base font-medium transition duration-200">Contacts</a>
                    <div class="border-t border-gray-200 pt-4">
                        <a href="{{ route('log') }}" class="text-blue-600 font-medium hover:text-blue-800 block px-3 py-2 transition duration-200">Connexion</a>
                        <a href="{{ route('enregistrer') }}" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 text-center block mt-2 transition duration-200">Inscription</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Section Hero améliorée -->
        <section class="relative h-screen flex justify-center items-center bg-[url('/images/open-book-with-flowers-arrangement.jpg')] bg-cover bg-fixed bg-center bg-no-repeat">
            <div class="absolute hero-gradient inset-0"></div>
            <div class="relative text-center p-8 max-w-4xl animate-fadeInUp">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow">PlumeUp</h1>
                <p class="text-xl md:text-2xl mb-8 text-white max-w-3xl mx-auto leading-relaxed text-shadow">
                    Bienvenue sur PlumeUP.<br/>
                    PlumeUp est une plateforme dédiée à la lecture et à la découverte de jeunes auteurs. 
                    On y trouve des histoires de tous genres : passion, amour, aventure, horreur, drame, éducatif, ainsi que des BD, des poèmes et des contes. 
                    C'est un espace où chaque plume peut s'exprimer librement et toucher un public curieux et passionné.
                </p>
                <a href="{{ route('log') }}" class="inline-block bg-blue-600 text-white text-xl px-8 py-4 rounded-full hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Connectez-vous à PlumeUp
                </a>
            </div>
        </section>

        <!-- Section titre améliorée -->
        <section id="catalogue" class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-amber-600 mb-4">Nos Histoires</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Découvrez une collection diversifiée d'histoires captivantes dans tous les genres</p>
            </div>
        </section>

        <!-- Grille de cartes améliorée -->
        <section class="bg-gray-50 pb-16">
            <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
                <!-- Carte Aventure & Action -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/world-book-day-celebration.jpg') }}" alt="Aventure" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-amber-600 mb-4">Aventure & Action</h3>
                        <p class="text-gray-600 leading-relaxed">Ces histoires sont des récits de quêtes, d'explorations et de défis pleins de rebondissements.</p>
                    </div>
                </div>

                <!-- Carte Romance -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/pexels-shubham-sharma-1420648-2912692.jpg') }}" alt="Romance" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-pink-600 mb-4">Romance</h3>
                        <p class="text-gray-600 leading-relaxed">Sur PlumeUp, les histoires de romance font vibrer les lecteurs à travers des récits d'amour sincères et émouvants.</p>
                    </div>
                </div>

                <!-- Carte Fantastique -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/portrait-d-un-enfant-avec-un-dragon-de-fantaisie.jpg') }}" alt="Fantasy" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-purple-600 mb-4">Fantastique & Fantasy</h3>
                        <p class="text-gray-600 leading-relaxed">Univers magiques, créatures imaginaires, pouvoirs surnaturels.</p>
                    </div>
                </div>

                <!-- Carte Science-Fiction -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/des-voyages-spatiaux-retro-futuristes.jpg') }}" alt="Sci-Fi" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-blue-600 mb-4">Science-Fiction</h3>
                        <p class="text-gray-600 leading-relaxed">Mondes futuristes, technologies avancées, voyages spatiaux et explorations des possibilités de l'humanité.</p>
                    </div>
                </div>

                <!-- Carte Horreur -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/c-est-une-scene-de-fantaisie-sombre.jpg') }}" alt="Horreur" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-red-600 mb-4">Horreur & Suspense</h3>
                        <p class="text-gray-600 leading-relaxed">Histoires effrayantes et psychologiquement angoissantes qui explorent les abîmes de l'humanité.</p>
                    </div>
                </div>

                <!-- Carte Policier -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/Wusstest du, dass _Alibi_ (Originaltitel_ The….jpeg') }}" alt="Policier" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-indigo-600 mb-4">Policier & Mystère</h3>
                        <p class="text-gray-600 leading-relaxed">Enquêtes palpitantes, crimes, complots et révélations surprenantes.</p>
                    </div>
                </div>

                <!-- Carte Drame -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/coup-moyen-femme-et-ville-double-exposition.jpg') }}" alt="Drame" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-600 mb-4">Drame & Réalisme</h3>
                        <p class="text-gray-600 leading-relaxed">Récits profonds et émouvants sur la vie, les épreuves et les émotions.</p>
                    </div>
                </div>

                <!-- Carte Historique -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/Explorez les secrets interdits des Mayas qui….jpeg') }}" alt="Historique" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-600 mb-4">Historique</h3>
                        <p class="text-gray-600 leading-relaxed">Histoires s'inspirant des époques passées, souvent inspirées de faits réels.</p>
                    </div>
                </div>

                <!-- Carte Jeunesse -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/_In an old, candlelit library, books float….jpeg') }}" alt="Jeunesse" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-green-600 mb-4">Jeunesse & Contes</h3>
                        <p class="text-gray-600 leading-relaxed">Histoires pour enfants et adolescents : contes, fables et aventures éducatives.</p>
                    </div>
                </div>

                <!-- Carte Poèmes -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/Lecture_Échange _ Quelle tristesse…👇😞😞….jpeg') }}" alt="Poésie" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-teal-600 mb-4">Poèmes & Textes courts</h3>
                        <p class="text-gray-600 leading-relaxed">Textes poétiques, réflexions brèves, pensées en vers ou en prose.</p>
                    </div>
                </div>

                <!-- Carte BD -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/Crée ta propre bande dessinée_ Cree Ta BD livre….jpeg') }}" alt="BD" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-orange-600 mb-4">Bande dessinée & Webtoon</h3>
                        <p class="text-gray-600 leading-relaxed">Récits illustrés sous forme de planches ou de bandes verticales.</p>
                    </div>
                </div>

                <!-- Carte Fanfiction -->
                <div class="bg-white rounded-2xl shadow-lg card-hover border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mb-6">
                            <img src="{{ asset('images/Plongez dans une aventure mystique où un homme….jpeg') }}" alt="Fanfiction" class="w-32 h-32 object-cover rounded-full mx-auto shadow-md" />
                        </div>
                        <h3 class="text-2xl font-bold text-violet-600 mb-4">Fanfiction & Univers dérivés</h3>
                        <p class="text-gray-600 leading-relaxed">Histoires inspirées d'œuvres célèbres (films, séries, jeux, livres…).</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section CTA améliorée -->
        <section class="py-20 bg-gradient-to-br from-gray-800 to-gray-900 text-white">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Rejoignez la communauté PlumeUp</h2>
                <p class="text-xl mb-10 text-gray-300">Commencez à lire ou à partager vos histoires dès maintenant</p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('enregistrer') }}" class="px-8 py-4 bg-amber-500 text-black font-semibold rounded-full hover:bg-amber-400 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        S'inscrire gratuitement
                    </a>
                    <a href="{{ route('log') }}" class="px-8 py-4 border-2 border-amber-500 text-amber-500 font-semibold rounded-full hover:bg-amber-500 hover:text-black transition duration-300">
                        Se connecter
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer amélioré -->
        <footer id="contact" class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <h2 class="text-3xl font-bold text-amber-400 mb-4">PlumeUp</h2>
                    <p class="text-gray-400 leading-relaxed">L'univers des jeunes auteurs en un clic. Découvrez, lisez et partagez des histoires extraordinaires.</p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-4 text-amber-400">Contact</h3>
                    <div class="space-y-2 text-gray-400">
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Pays : Bénin</p>
                        <p><i class="fas fa-envelope mr-2"></i>jeanpaulgnikpo65@gmail.com</p>
                        <p><i class="fas fa-phone mr-2"></i>+229 40 42 30 21</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-4 text-amber-400">Navigation</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-amber-400 transition duration-200">Accueil</a></li>
                        <li><a href="#catalogue" class="hover:text-amber-400 transition duration-200">Catalogue</a></li>
                        <li><a href="#about" class="hover:text-amber-400 transition duration-200">À propos</a></li>
                        <li><a href="#contact" class="hover:text-amber-400 transition duration-200">Contacts</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-4 text-amber-400">Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('enregistrer') }}" class="block px-6 py-3 bg-amber-500 text-black font-semibold rounded-lg hover:bg-amber-400 transition duration-200 text-center">
                            Inscription
                        </a>
                        <a href="{{ route('log') }}" class="block px-6 py-3 border border-amber-500 text-amber-500 font-semibold rounded-lg hover:bg-amber-500 hover:text-black transition duration-200 text-center">
                            Connexion
                        </a>
                        @if(auth()->user())
                        <a href="{{ route('deconnexion') }}" class="block px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-200 text-center">
                            Déconnexion
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 text-center text-gray-500">
                <p>&copy; 2025 PlumeUp — Tous droits réservés.</p>
            </div>
        </footer>
    </body> 
</html>