<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Liste des utilisateurs</title>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen p-6">
    <nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <div class="h-8 w-8 bg-primary-600 rounded-lg flex items-center justify-center">
                <img src="{{ asset('images/téléchargement.jpeg') }}" alt="Logo" class="h-10 w-auto opacity-60">
            </div>
            <span class="ml-2 text-xl font-bold text-gray-900">PlumeUP</span>
          </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
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
              <a href="#" class="text-black hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">À propos</a<a href="#" class="bg-primary-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-primary-700 transition-colors">Publier</a>
          </div>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button id="menu-toggle" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-md">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 pt-2 pb-3">
        <div class="px-2 space-y-1">
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
  </nav>
  <form action="{{ route('webd') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
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
            <input type="file" id="fichier_chapitre" name="images[]" multiple accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
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
</body>
</html>