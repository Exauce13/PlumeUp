<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Soumission d'un chapitre</title>
  <style>
    .form-bg {
      background-color: #f9fafb;
      background-image: radial-gradient(#e0f2fe 0.5px, transparent 0.5px), radial-gradient(#e0f2fe 0.5px, #f9fafb 0.5px);
      background-size: 20px 20px;
      background-position: 0 0, 10px 10px;
    }
    
    .navbar-shadow {
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .footer-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
  </style>
</head>
<body class="form-bg min-h-screen flex flex-col">
  <!-- Navbar -->
  <nav class="bg-white navbar-shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
              PluemeUP
            </h1>
          </div>
        </div>
        
        <!-- Navigation Links (Desktop) -->
        <div class="hidden md:block">
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
        
        <!-- User Menu (Desktop) -->
        <div class="hidden md:flex items-center space-x-4">
          <div class="relative">
            <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 focus:outline-none">
              <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                <span class="text-white text-sm font-medium">U</span>
              </div>
              <span class="text-sm font-medium">Utilisateur</span>
            </button>
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
          <h2 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            PlumeUP
          </h2>
          <label for="mobile-menu-toggle" class="text-gray-700 hover:text-blue-600 cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </label>
        </div>
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
        <div class="mt-8 pt-4 border-t border-gray-200">
          <div class="flex items-center space-x-3 px-4 py-2">
            <img src="{{ asset('storage/'. Auth::user()->avatar)}}" alt="" class="rounded-full w-20 h-20 object-cover">
            <p class="font-bold text-plume-yellow">{{ Auth::user()->name }}</p>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow flex items-center justify-center p-4">
    <div class="w-full max-w-2xl">
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white text-center">
          <h2 class="text-3xl font-bold mb-1">Soumission d'un chapitre</h2>
          <p class="opacity-90">Ajoutez un nouveau chapitre à votre histoire</p>
        </div>
        
        <form action="{{ route('chapitre') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
          @csrf
          @method('POST')
          <input type="hidden" name="histoire_id" value="{{ $histoires->id }}" />
          
          <!-- Titre du chapitre -->
          <div>
            <label for="titre_chapitre" class="block text-sm font-semibold text-gray-700 mb-2">Titre du chapitre</label>
            <input type="text" id="titre_chapitre" name="titre" value="{{ old('titre') }}"
              class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Entrez le titre du chapitre" required />
            @error('titre')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <!-- Numéro du chapitre -->
          <div>
            <label for="numero_chapitre" class="block text-sm font-semibold text-gray-700 mb-2">Numéro du chapitre</label>
            <input type="number" id="numero_chapitre" name="numero" value="{{ old('numero') }}" min="1"
              class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Entrez le numéro du chapitre" required />
            @error('numero')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <!-- Fichier du chapitre -->
          <div>
            <label for="fichier_chapitre" class="block text-sm font-semibold text-gray-700 mb-2">Fichier du chapitre</label>
            <input type="file" id="fichier_chapitre" name="fichier"
              accept="pdf.doc,.docx,.pdf,.cbz,.cbr,.zip"
              class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
              required />
            @error('fichier')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <!-- Bouton de soumission -->
          <div>
            <button type="submit"
              class="w-full py-3 px-6 rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 font-semibold">
              Enregistrer le chapitre
            </button>
          </div>
        </form>
        
        <div class="bg-gray-100 px-6 py-4 text-center text-xs text-gray-500 border-t border-gray-200">
          <p>Tous les champs sont obligatoires. Fichiers acceptés : .doc, .docx, .pdf, .cbz, .cbr, .zip</p>
        </div>
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
            Votre plateforme de gestion d'histoires et de chapitres. Créez, organisez et partagez vos récits en toute simplicité.
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-200 hover:text-white transition-colors">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
              </svg>
            </a>
            <a href="#" class="text-gray-200 hover:text-white transition-colors">
              <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
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
          <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Accueil</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Mes Histoires</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Bibliothèque</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Aide</a></li>
          </ul>
        </div>
        
        <!-- Support -->
        <div>
          <h4 class="text-lg font-semibold mb-4">Support</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Centre d'aide</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Contact</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">FAQ</a></li>
            <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Politique de confidentialité</a></li>
          </ul>
        </div>
      </div>
      
      <div class="border-t border-white/20 mt-8 pt-8 text-center">
        <p class="text-gray-200">
          © 2025 PlumeUP. Tous droits réservés à PlumeUp. | Développé avec ❤️ pour les passionnés d'écriture
        </p>
      </div>
    </div>
  </footer>
</body>
</html>