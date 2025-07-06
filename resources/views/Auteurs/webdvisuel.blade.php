<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <title>Liste des Chapitres</title>
  <style>
    .page-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    
    .content-bg {
      background-color: #f8fafc;
      background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px), radial-gradient(#e2e8f0 0.5px, #f8fafc 0.5px);
      background-size: 20px 20px;
      background-position: 0 0, 10px 10px;
    }
    
    .navbar-shadow {
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .chapter-card {
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }
    
    .chapter-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .nav-link {
      position: relative;
      transition: all 0.3s ease;
    }
    
    .nav-link:hover::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, #3b82f6, #1d4ed8);
      border-radius: 1px;
    }
    
    .mobile-menu-toggle {
      display: none;
    }
    
    .mobile-menu-toggle:checked + .mobile-menu {
      transform: translateX(0);
    }
    
    .mobile-menu {
      transform: translateX(-100%);
      transition: transform 0.3s ease-in-out;
    }
    
    .header-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .footer-gradient {
      background: linear-gradient(135deg, #4c51bf 0%, #553c9a 100%);
    }
    
    .chapter-number {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
</head>
<body class="page-bg">
  <!-- Navbar -->
  <nav class="bg-white navbar-shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <div class="flex-shrink-8">
            <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto">
          </div>
          <div class="flex-shrink-0">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-yellow-600 bg-clip-text text-transparent">
              PlumeUP
            </h1>
          </div>
        </div>
        
        <!-- Navigation Links (Desktop) -->
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-8">
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
        
        <!-- User Menu (Desktop) -->
        <div class="hidden md:flex items-center space-x-4">
          <div class="relative">
            <div class="flex items-center space-x-2 text-gray-700">
                <img src="{{ asset('storage/'. Auth::user()->avatar)}}" alt="" class="rounded-full w-10 h-10 object-cover">
                <p class="font-bold text-plume-yellow">{{ Auth::user()->name }}</p>
            </div>
          </div>
        </div>
        
        <!-- Mobile menu button -->
        <div class="md:hidden">
          <label for="mobile-menu-toggle" class="text-gray-700 hover:text-blue-600 cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </label>
        </div>
      </div>
    </div>
    
    <!-- Mobile Navigation Menu -->
    <input type="checkbox" id="mobile-menu-toggle" class="mobile-menu-toggle">
    <div class="mobile-menu md:hidden fixed inset-y-0 left-0 w-64 bg-white shadow-lg z-50">
      <div class="p-4">
        <div class="flex items-center justify-between mb-8">
          <h2 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-yellow-600 bg-clip-text text-transparent">
            PlumeUP
          </h2>
          <label for="mobile-menu-toggle" class="text-gray-700 hover:text-blue-600 cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </label>
        </div>
        
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

        
        <div class="mt-8 pt-4 border-t border-gray-200">
          <div class="flex items-center space-x-3 px-4 py-2">
            <img src="{{ asset('storage/'. Auth::user()->avatar)}}" alt="" class="rounded-full w-20 h-20 object-cover">
            <p class="font-bold text-plume-yellow">{{ Auth::user()->name }}</p>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Header Section -->
  <header class="header-gradient text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <div class="mb-8">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">
          Liste des Chapitres
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
          Découvrez tous vos chapitres organisés et prêts à être consultés
        </p>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="content-bg py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Title -->
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Vos Chapitres</h2>
        <p class="text-gray-600">Cliquez sur "Voir" pour consulter un chapitre</p>
      </div>

      <!-- Chapters Grid -->
      <div class="space-y-4">
        @foreach ($tome as $chapit)
        <div class="chapter-card bg-white/80 rounded-xl shadow-lg border border-gray-200 overflow-hidden">
          <div class="p-6">
            <div class="flex items-center justify-between">
              <!-- Left Side: Chapter Info -->
              <div class="flex-1 flex items-center space-x-4">
                <!-- Chapter Number Badge -->
                <div class="flex-shrink-0">
                  <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">{{ $chapit->numerochapitre }}</span>
                  </div>
                </div>
                
                <!-- Chapter Details -->
                <div class="flex-1 min-w-0">
                  <h3 class="text-xl font-bold text-gray-900 mb-1 truncate">
                    {{ $chapit->titre }}
                  </h3>
                  <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span class="flex items-center">
                      <i class="fas fa-bookmark mr-1"></i>
                      Chapitre {{ $chapit->numerochapitre }}
                    </span>
                    <span class="flex items-center">
                      <i class="fas fa-calendar mr-1"></i>
                      Publié récemment
                    </span>
                    <span class="flex items-center">
                      <i class="fas fa-file-alt mr-1"></i>
                    </span>
                  </div>
                </div>
              </div>
              
              <!-- Right Side: Action Button -->
              <div class="flex-shrink-0 ml-6">
                <a href="{{route('voir', $chapit->id)}}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                  <i class="fas fa-eye"></i>
                  <span>Voir</span>
                  <i class="fas fa-external-link-alt text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer-gradient text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- About Section -->
        <div class="col-span-1 md:col-span-2">
          <h3 class="text-2xl font-bold mb-4">PlumeUP</h3>
          <p class="text-gray-200 mb-4 leading-relaxed">
            Votre plateforme de gestion d'histoires. Créez, organisez et partagez vos récits en toute simplicité avec une interface moderne et intuitive.
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-200 hover:text-white transition-colors">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
              </svg>
            </a>
            <a href="#" class="text-gray-200 hover:text-white transition-colors">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
              </svg>
            </a>
            <a href="#" class="text-gray-200 hover:text-white transition-colors">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
            </a>
          </div>
        </div>
        
        <!-- Quick Links -->
        <div>
          <h4 class="text-lg font-semibold mb-4">Navigation</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Accueil</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Mes Histoires</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Chapitres</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Bibliothèque</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Profil</a></li>
          </ul>
        </div>
        
        <!-- Support -->
        <div>
          <h4 class="text-lg font-semibold mb-4">Support</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Centre d'aide</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Contact</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Documentation</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">FAQ</a></li>
          </ul>
        </div>
      </div>
      
      <div class="border-t border-white/20 mt-8 pt-8 text-center">
        <p class="text-gray-200">
          © 2025 PlumeUP. Tous droits réservés à PlumeUP. | Développé avec passion pour les écrivains
        </p>
      </div>
    </div>
  </footer>
</body>
</html>