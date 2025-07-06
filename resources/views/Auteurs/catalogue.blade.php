<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Liste des utilisateurs</title>
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .table-row-hover:hover {
      background: linear-gradient(90deg, #f8fafc 0%, #e2e8f0 100%);
      transform: scale(1.01);
    }
    
    .primary-600 {
      background-color: #4f46e5;
    }
    
    .primary-700 {
      color: #4338ca;
    }
    
    .primary-100 {
      background-color: #e0e7ff;
    }
    
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .story-card {
      background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
      border: 1px solid rgba(148, 163, 184, 0.1);
      transition: all 0.3s ease;
    }
    
    .story-card:hover {
      background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
  <!-- Navigation avec effet glassmorphism -->
  <nav class="glass-effect shadow-lg border-b border-white/20 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo amélioré -->
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <div class="h-10 w-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl flex items-center justify-center animate-float shadow-lg">
              <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-8 w-auto rounded-lg">
            </div>
            <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">PlumeUP</span>
          </div>
        </div>

        <!-- Desktop Menu avec effets -->
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-2">
             <a href="{{ route('accueil') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">Accueil</a>
             <a href="{{ route('actions') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">Histoires</a>
             <a href="{{ route('listesd') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">Discussion</a>
             @if(auth()->user()->statut == 'auteur')
             <a href="{{ route('pghistoires') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">Mes histoires</a>
             <a href="{{ route('catalogues') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">Catalogue</a>
              @endif
              @if(auth()->user()->statut == 'SuperAdmin')
              <a href="{{ route('yes') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">PgAdmin</a>
              @endif
              <a href="{{ route('profiles') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">Profil</a>
              <a href="#" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 hover:scale-105">À propos</a>
              <a href="#" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-2 rounded-xl text-sm font-medium hover:from-emerald-600 hover:to-teal-700 transition-all duration-200 hover:scale-105 shadow-lg">Publier</a>
          </div>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button id="menu-toggle" class="text-gray-600 hover:text-purple-600 hover:bg-white/50 p-2 rounded-xl transition-all duration-200">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200/50 pt-2 pb-3">
        <div class="px-2 space-y-1">
          <a href="{{ route('accueil') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-3 py-2 rounded-xl text-base font-medium block transition-all duration-200">Accueil</a>
          <a href="{{ route('actions') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-3 py-2 rounded-xl text-base font-medium block transition-all duration-200">Histoires</a>
          <a href="{{ route('listesd') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-3 py-2 rounded-xl text-base font-medium block transition-all duration-200">Discussion</a>
          @if(auth()->user()->statut == 'auteur')
          <a href="{{ route('pghistoires') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-3 py-2 rounded-xl text-base font-medium block shadow-lg">Mes histoires</a>
          <a href="{{ route('catalogues') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-3 py-2 rounded-xl text-base font-medium block transition-all duration-200">Catalogue</a>
          @endif
          @if(auth()->user()->statut == 'SuperAdmin')
          <a href="{{ route('yes') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-3 py-2 rounded-xl text-base font-medium block transition-all duration-200">PgAdmin</a>
          @endif
          <a href="{{ route('profiles') }}" class="text-gray-700 hover:bg-white/50 hover:text-purple-600 px-3 py-2 rounded-xl text-base font-medium block transition-all duration-200">Contacts</a>
          <a href="{{ route('deconnexion') }}" class="bg-gradient-to-r from-red-500 to-pink-600 text-white mt-2 px-4 py-2 rounded-xl text-center hover:from-red-600 hover:to-pink-700 transition-all duration-200 block shadow-lg">Déconnexion</a>
        </div>
      </div>
  </nav>

  <!-- Hero Section -->
  <div class="relative overflow-hidden bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-700 py-16">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
          <i class="fas fa-book-open mr-3"></i>
          Mes Histoires
        </h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
          Découvrez et gérez vos créations littéraires dans votre espace personnel
        </p>
      </div>
    </div>
    <!-- Éléments décoratifs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
      <div class="absolute -top-4 -left-4 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-4 -right-4 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="glass-effect rounded-2xl shadow-2xl p-8 card-hover">
      <!-- En-tête avec statistiques -->
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8">
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-feather-alt text-purple-600 mr-2"></i>
            Vos Créations
          </h2>
          <p class="text-gray-600">Gérez et développez vos histoires</p>
        </div>
        <div class="flex space-x-4 mt-4 lg:mt-0">
          <div class="bg-gradient-to-r from-purple-500 to-blue-600 text-white px-6 py-3 rounded-xl text-center shadow-lg">
            <div class="text-2xl font-bold">{{ count($meshistoires ?? []) }}</div>
            <div class="text-sm opacity-90">Histoires</div>
          </div>
          <div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-3 rounded-xl text-center shadow-lg">
            <div class="text-2xl font-bold">
              <i class="fas fa-plus"></i>
            </div>
            <div class="text-sm opacity-90">Créer</div>
          </div>
        </div>
      </div>

      <!-- Table responsive améliorée -->
      <div class="overflow-x-auto">
        <div class="min-w-full">
          <!-- En-tête de table stylisé -->
          <div class="bg-gradient-to-r from-purple-100 to-blue-100 rounded-t-xl p-4 grid grid-cols-1 md:grid-cols-4 gap-4 font-semibold text-gray-700 text-sm uppercase tracking-wider">
            <div class="flex items-center">
              <i class="fas fa-book text-purple-600 mr-2"></i>
              Titre
            </div>
            <div class="flex items-center">
              <i class="fas fa-tag text-blue-600 mr-2"></i>
              Type
            </div>
            <div class="flex items-center">
              <i class="fas fa-broadcast-tower text-indigo-600 mr-2"></i>
              Mode diffusion
            </div>
            <div class="flex items-center">
              <i class="fas fa-cog text-gray-600 mr-2"></i>
              Actions
            </div>
          </div>

          <!-- Contenu de la table -->
          <div class="bg-white rounded-b-xl shadow-inner">
            @forelse($meshistoires as $histoire)
            <div class="story-card p-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-center border-b border-gray-100 last:border-b-0 table-row-hover transition-all duration-300">
              <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                  <i class="fas fa-book-open text-white text-lg"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800 text-lg">{{ $histoire->titre_book }}</h3>
                  <p class="text-sm text-gray-500">Histoire créée</p>
                </div>
              </div>
              
              <div class="flex items-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                  @if($histoire->type_book == 'Bande dessinée & Webtoon')
                    bg-gradient-to-r from-pink-100 to-purple-100 text-purple-700
                  @else
                    bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-700
                  @endif">
                  <i class="fas fa-{{ $histoire->type_book == 'Bande dessinée & Webtoon' ? 'image' : 'book' }} mr-2"></i>
                  {{ $histoire->type_book }}
                </span>
              </div>
              
              <div class="flex items-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-emerald-100 to-teal-100 text-teal-700">
                  <i class="fas fa-{{ $histoire->modediffusion == 'Par chapitres ou tomes' ? 'list-ol' : 'file-alt' }} mr-2"></i>
                  {{ $histoire->modediffusion }}
                </span>
              </div>
              
              <div class="flex justify-start md:justify-end">
                @if(($histoire->modediffusion == 'Par chapitres ou tomes') && ($histoire->type_book =='Bande dessinée & Webtoon'))
                <a href="{{ route('webdform', $histoire->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                  <i class="fas fa-plus mr-2"></i>
                  Nouveau chapitre
                </a>
                @elseif($histoire->modediffusion == 'Par chapitres ou tomes')
                <a href="{{ route('form', $histoire->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                  <i class="fas fa-plus mr-2"></i>
                  Nouveau chapitre
                </a>
                @endif
              </div>
            </div>
            @empty
            <div class="text-center py-16">
              <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book-open text-3xl text-purple-600"></i>
              </div>
              <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucune histoire trouvée</h3>
              <p class="text-gray-600 mb-6">Commencez à créer votre première histoire dès maintenant !</p>
              <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl hover:from-purple-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                <i class="fas fa-plus mr-2"></i>
                Créer une histoire
              </a>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Script pour le menu mobile -->
  <script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>