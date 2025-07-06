<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bibliothèque</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * { font-family: 'Inter', sans-serif; }
        
        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .neon-glow {
            box-shadow: 0 0 30px rgba(102, 126, 234, 0.3);
        }
        
        .animated-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulseGlow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.8); }
        }
        
        .sidebar-item {
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .sidebar-item:hover::before {
            left: 100%;
        }
        
        .modern-table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }
        
        .table-row {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .table-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(102, 126, 234, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(102, 126, 234, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
    </style>
</head>
<body class="bg-gray-50 cyber-grid min-h-screen">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-72 animated-bg shadow-2xl">
        <div class="flex items-center justify-center h-20 glass-effect m-4 rounded-2xl">
            <div class="text-center">
                <h1 class="text-2xl font-black text-white tracking-wider">PlumeUP</h1>
                <p class="text-xs text-white/80 font-medium">ADMIN PORTAL</p>
            </div>
        </div>
        
        <nav class="mt-8 px-4">
            <div class="space-y-3">
                <a href='{{ route('yes') }}' class="sidebar-item w-full flex items-center px-6 py-4 text-white/90 rounded-2xl morphism hover:bg-white/20 transition-all duration-300 group">
                    <div class="p-2 bg-white/20 rounded-xl mr-4 group-hover:bg-white/30 transition-all duration-300">
                        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Tableau de Bord</div>
                        <div class="text-xs text-white/70">Vue d'ensemble</div>
                    </div>
                </a>
                
                <a href="{{ route('listes') }}" class="sidebar-item w-full flex items-center px-6 py-4 text-white/90 rounded-2xl morphism hover:bg-white/20 transition-all duration-300 group">
                    <div class="p-2 bg-white/20 rounded-xl mr-4 group-hover:bg-white/30 transition-all duration-300">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Gestion des Livres</div>
                        <div class="text-xs text-white/70">Catalogue & Édition</div>
                    </div>
                </a>
                
                <a href="{{ route('lusers') }}" class="sidebar-item w-full flex items-center px-6 py-4 text-white/90 rounded-2xl morphism hover:bg-white/20 transition-all duration-300 group">
                    <div class="p-2 bg-white/20 rounded-xl mr-4 group-hover:bg-white/30 transition-all duration-300">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Utilisateurs</div>
                        <div class="text-xs text-white/70">Communauté</div>
                    </div>
                </a>
                
                <a href="#" class="sidebar-item w-full flex items-center px-6 py-4 text-white/90 rounded-2xl morphism hover:bg-white/20 transition-all duration-300 group">
                    <div class="p-2 bg-white/20 rounded-xl mr-4 group-hover:bg-white/30 transition-all duration-300">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Private</div>
                        <div class="text-xs text-white/70">Zone sécurisée</div>
                    </div>
                </a>
                
                <a href="#" class="sidebar-item w-full flex items-center px-6 py-4 text-white/90 rounded-2xl morphism hover:bg-white/20 transition-all duration-300 group">
                    <div class="p-2 bg-white/20 rounded-xl mr-4 group-hover:bg-white/30 transition-all duration-300">
                        <i data-lucide="trending-up" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Analytiques</div>
                        <div class="text-xs text-white/70">Métriques & Stats</div>
                    </div>
                </a>
                
                <a href="#" class="sidebar-item w-full flex items-center px-6 py-4 text-white/90 rounded-2xl morphism hover:bg-white/20 transition-all duration-300 group">
                    <div class="p-2 bg-white/20 rounded-xl mr-4 group-hover:bg-white/30 transition-all duration-300">
                        <i data-lucide="settings" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Paramètres</div>
                        <div class="text-xs text-white/70">Configuration</div>
                    </div>
                </a>
            </div>
        </nav>
        
        <!-- Sidebar Footer -->
        <div class="absolute bottom-6 left-4 right-4">
            <div class="morphism rounded-2xl p-4 text-center">
                <div class="w-12 h-12 bg-white/20 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <i data-lucide="crown" class="w-6 h-6 text-yellow-400"></i>
                </div>
                <p class="text-white text-sm font-semibold">Admin Premium</p>
                <p class="text-white/70 text-xs">Accès complet</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-72 min-h-screen">
        <!-- Top Bar -->
        <header class="bg-white/80 backdrop-blur-xl border-b border-white/20 sticky top-0 z-40">
            <div class="flex items-center justify-between px-8 py-6">
                <div class="flex items-center space-x-6">
                    <div class="p-3 bg-gradient-to-r from-purple-500/20 to-blue-500/20 rounded-xl">
                        <i data-lucide="zap" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Tableau de Bord</h2>
                        <p class="text-gray-600 text-sm">Gestion avancée de la bibliothèque</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="pl-12 pr-4 py-3 w-80 bg-white/50 border border-white/30 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 backdrop-blur-xl">
                        <i data-lucide="search" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    </div>
                    
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-3 bg-white/50 rounded-2xl hover:bg-white/70 transition-all duration-300 backdrop-blur-xl">
                            <i data-lucide="bell" class="w-5 h-5 text-gray-600"></i>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center pulse-glow">3</span>
                        </button>
                    </div>
                    
                    <!-- Profile -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center">
                            <img src="{{ asset('storage/'. Auth::user()->avatar)}}" alt="" class="rounded-full w-7 h-7 object-cover">
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Connecté</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="gradient-card rounded-3xl p-6 hover-lift floating">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Livres</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">2,847</p>
                            <p class="text-green-500 text-sm mt-1">↗ +12% ce mois</p>
                        </div>
                        <div class="p-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl">
                            <i data-lucide="book" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="gradient-card rounded-3xl p-6 hover-lift floating" style="animation-delay: 0.5s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Utilisateurs Actifs</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">1,264</p>
                            <p class="text-green-500 text-sm mt-1">↗ +8% ce mois</p>
                        </div>
                        <div class="p-4 bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl">
                            <i data-lucide="users" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="gradient-card rounded-3xl p-6 hover-lift floating" style="animation-delay: 1s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Emprunts Actifs</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">892</p>
                            <p class="text-orange-500 text-sm mt-1">↔ Stable</p>
                        </div>
                        <div class="p-4 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl">
                            <i data-lucide="bookmark" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                </div>

                <div class="gradient-card rounded-3xl p-6 hover-lift floating" style="animation-delay: 1.5s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Revenus Mensuels</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">€4,321</p>
                            <p class="text-green-500 text-sm mt-1">↗ +18% ce mois</p>
                        </div>
                        <div class="p-4 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl">
                            <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="gradient-card rounded-3xl p-8 hover-lift">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Activité Récente</h3>
                        <button class="text-purple-600 hover:text-purple-800 text-sm font-medium">Voir tout</button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="book-plus" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Nouveau livre ajouté</p>
                                <p class="text-sm text-gray-600">"L'Art de la Programmation"</p>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 2h</span>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="user-plus" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Nouvel utilisateur</p>
                                <p class="text-sm text-gray-600">Marie Dubois s'est inscrite</p>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 4h</span>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl">
                            <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="clock" class="w-5 h-5 text-orange-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Retard d'emprunt</p>
                                <p class="text-sm text-gray-600">"Le Petit Prince" - Jean Martin</p>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 1j</span>
                        </div>
                    </div>
                </div>

                <div class="gradient-card rounded-3xl p-8 hover-lift">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Livres Populaires</h3>
                        <button class="text-purple-600 hover:text-purple-800 text-sm font-medium">Voir plus</button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl">
                            <div class="w-12 h-16 bg-gradient-to-b from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Clean Code</p>
                                <p class="text-sm text-gray-600">Robert C. Martin</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex space-x-1">
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">147 emprunts</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl">
                            <div class="w-12 h-16 bg-gradient-to-b from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Design Patterns</p>
                                <p class="text-sm text-gray-600">Gang of Four</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex space-x-1">
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">128 emprunts</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl">
                            <div class="w-12 h-16 bg-gradient-to-b from-purple-400 to-purple-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">JavaScript: The Good Parts</p>
                                <p class="text-sm text-gray-600">Douglas Crockford</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex space-x-1">
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">115 emprunts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modern Footer -->
        <footer class="relative overflow-hidden">
            <!-- Animated Background -->
            <div class="absolute inset-0 animated-bg opacity-90"></div>
            <div class="absolute inset-0 cyber-grid opacity-30"></div>
            
            <!-- Main Footer Content -->
            <div class="relative z-10 morphism border-t border-white/10">
                <div class="px-8 py-12">
                    <!-- Footer Top Section -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                        <!-- Brand Section -->
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center pulse-glow">
                                    <i data-lucide="library" class="w-7 h-7 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black text-white tracking-wider">PlumeUP</h3>
                                    <p class="text-white/70 text-sm">Bibliothèque Numérique Premium</p>
                                </div>
                            </div>
                            <p class="text-white/80 text-sm leading-relaxed mb-6 max-w-md">
                                Révolutionnez votre expérience de lecture avec notre plateforme innovante. 
                                Découvrez, empruntez et explorez des milliers d'ouvrages dans un environnement moderne et intuitif.
                            </p>
                            
                            <!-- Social Links -->
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                    <i data-lucide="facebook" class="w-5 h-5 text-white"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                    <i data-lucide="twitter" class="w-5 h-5 text-white"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                    <i data-lucide="instagram" class="w-5 h-5 text-white"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                    <i data-lucide="linkedin" class="w-5 h-5 text-white"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-white font-bold mb-4 text-lg">Liens Rapides</h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="chevron-right" class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Catalogue
                                </a></li>
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="chevron-right" class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Nouveautés
                                </a></li>
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="chevron-right" class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Recommandations
                                </a></li>
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="chevron-right" class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Mon Compte
                                </a></li>
                            </ul>
                        </div>
                        
                        <!-- Support -->
                        <div>
                            <h4 class="text-white font-bold mb-4 text-lg">Support & Aide</h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="help-circle" class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                                    FAQ
                                </a></li>
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="mail" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                    Contact
                                </a></li>
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                                    +33 1 23 45 67 89
                                </a></li>
                                <li><a href="#" class="text-white/70 hover:text-white transition-colors duration-300 text-sm flex items-center group">
                                    <i data-lucide="shield" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                    Confidentialité
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Stats Bar -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                        <div class="text-center p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl font-bold text-white mb-1">2,847</div>
                            <div class="text-white/70 text-sm">Livres Disponibles</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl font-bold text-white mb-1">1,264</div>
                            <div class="text-white/70 text-sm">Membres Actifs</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl font-bold text-white mb-1">98.5%</div>
                            <div class="text-white/70 text-sm">Satisfaction</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl font-bold text-white mb-1">24/7</div>
                            <div class="text-white/70 text-sm">Support</div>
                        </div>
                    </div>
                    
                    <!-- Newsletter -->
                    <div class="bg-white/10 rounded-3xl p-8 mb-8 text-center">
                        <div class="max-w-2xl mx-auto">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 pulse-glow">
                                <i data-lucide="mail" class="w-8 h-8 text-white"></i>
                            </div>
                            <h4 class="text-white font-bold text-xl mb-2">Restez Informé</h4>
                            <p class="text-white/70 text-sm mb-6">Recevez nos dernières nouveautés et recommandations personnalisées</p>
                            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                                <input type="email" placeholder="votre@email.com" class="flex-1 px-6 py-3 bg-white/20 border border-white/30 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 backdrop-blur-xl">
                                <button class="px-8 py-3 bg-white text-purple-600 font-semibold rounded-2xl hover:bg-white/90 transition-all duration-300 hover:scale-105">
                                    S'abonner
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Bottom -->
                    <div class="flex flex-col md:flex-row items-center justify-between pt-8 border-t border-white/20">
                        <div class="flex items-center space-x-6 mb-4 md:mb-0">
                            <p class="text-white/60 text-sm">© 2025 PlumeUP. Tous droits réservés.</p>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-white/60 text-xs">Système opérationnel</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6">
                            <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-300">Mentions Légales</a>
                            <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-300">CGU</a>
                            <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-300">Cookies</a>
                            
                            <!-- Back to Top Button -->
                            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group">
                                <i data-lucide="chevron-up" class="w-5 h-5 text-white group-hover:-translate-y-1 transition-transform duration-300"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Floating Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-white/5 rounded-full blur-xl floating"></div>
            <div class="absolute top-20 right-20 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl floating" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-10 left-1/3 w-16 h-16 bg-blue-500/10 rounded-full blur-xl floating" style="animation-delay: 4s;"></div>
        </footer>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Add smooth scrolling and interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth hover effects for cards
            const cards = document.querySelectorAll('.hover-lift');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.filter = 'brightness(1.05)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.filter = 'brightness(1)';
                });
            });
            
            // Add click effects to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
    
    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>
</body>
</html>