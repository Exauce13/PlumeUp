<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          }
        }
      }
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function () {
      // Menu mobile toggle
      $('#menu-toggle').click(function () {
        $('#mobile-menu').toggleClass('hidden');
      });
      
      // Animation sur focus des inputs
      $('input, select').focus(function() {
        $(this).addClass('ring-2 ring-primary-500');
      }).blur(function() {
        $(this).removeClass('ring-2 ring-primary-500');
      });
      
      // Gestion du changement de type d'histoire
      $('#book').change(function() {
        const selectedType = $(this).val();
        const $documentField = $('#document-field');
        const $imageField = $('#image-field');
        
        if (selectedType === 'Bande dessinée & Webtoon') {
          $documentField.addClass('hidden');
          $imageField.removeClass('hidden');
          // Retirer l'attribut required du champ document et l'ajouter au champ images
          $('#histoire').removeAttr('required');
          $('#histoire_images').attr('required', true);
        } else {
          $documentField.removeClass('hidden');
          $imageField.addClass('hidden');
          // Retirer l'attribut required du champ images et l'ajouter au champ document
          $('#histoire_images').removeAttr('required');
          $('#histoire').attr('required', true);
        }
      });
      
      // Prévisualisation du fichier sélectionné avec validation de taille
      $('input[type="file"]').change(function() {
        const fileName = $(this).val().split('\\').pop();
        const file = this.files[0];
        
        if (fileName && file) {
          let maxSize, maxSizeMB;
          
          // Définir la taille max selon le type de fichier
          if ($(this).attr('id') === 'histoire') {
            maxSize = 1073741824; // 1GB pour histoire
            maxSizeMB = 1024;
          } else if ($(this).attr('id') === 'histoire_images') {
            maxSize = 52428800; // 50MB pour images multiples
            maxSizeMB = 50;
          } else {
            maxSize = 10485760; // 10MB pour image de couverture
            maxSizeMB = 10;
          }
          
          const fileSize = file.size;
          const fileSizeMB = (fileSize / (1024 * 1024)).toFixed(2);
          
          if (fileSize > maxSize) {
            alert(`Le fichier sélectionné (${fileSizeMB} MB) dépasse la taille maximale autorisée (${maxSizeMB} MB).`);
            $(this).val('');
            $(this).closest('.file-upload-area').find('.file-name').addClass('hidden');
            return;
          }
          
          const displayText = `${fileName} (${fileSizeMB} MB)`;
          $(this).closest('.file-upload-area').find('.file-name').text(displayText).removeClass('hidden');
          
          // Afficher une barre de progression pour les gros fichiers
          if (fileSize > 50 * 1024 * 1024) { // Plus de 50MB
            showUploadProgress($(this));
          }
        }
      });
      
      // Gestion spéciale pour les fichiers multiples d'images
      $('#histoire_images').change(function() {
        const files = this.files;
        const $fileNameContainer = $(this).closest('.file-upload-area').find('.file-name');
        
        if (files.length > 0) {
          let totalSize = 0;
          let fileNames = [];
          
          for (let i = 0; i < files.length; i++) {
            totalSize += files[i].size;
            fileNames.push(files[i].name);
          }
          
          const totalSizeMB = (totalSize / (1024 * 1024)).toFixed(2);
          const maxSize = 52428800; // 50MB total
          
          if (totalSize > maxSize) {
            alert(`Les fichiers sélectionnés (${totalSizeMB} MB) dépassent la taille maximale autorisée (50 MB au total).`);
            $(this).val('');
            $fileNameContainer.addClass('hidden');
            return;
          }
          
          const displayText = files.length === 1 ? 
            `${fileNames[0]} (${totalSizeMB} MB)` : 
            `${files.length} fichiers sélectionnés (${totalSizeMB} MB)`;
          
          $fileNameContainer.text(displayText).removeClass('hidden');
        }
      });
      
      // Fonction pour afficher la progression d'upload
      function showUploadProgress($input) {
        const $progressContainer = $input.closest('.file-upload-area').find('.upload-progress');
        if ($progressContainer.length === 0) {
          $input.closest('.file-upload-area').append(`
            <div class="upload-progress mt-3 hidden">
              <div class="bg-gray-200 rounded-full h-2">
                <div class="bg-primary-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
              </div>
              <p class="text-xs text-gray-600 mt-1">Préparation du fichier...</p>
            </div>
          `);
        }
      }
      
      // Intercepter la soumission du formulaire pour les gros fichiers
      $('form').submit(function(e) {
        const histoireFile = $('#histoire')[0].files[0];
        const histoireImages = $('#histoire_images')[0].files;
        
        let shouldShowProgress = false;
        
        if (histoireFile && histoireFile.size > 50 * 1024 * 1024) {
          shouldShowProgress = true;
        }
        
        if (histoireImages && histoireImages.length > 0) {
          let totalSize = 0;
          for (let i = 0; i < histoireImages.length; i++) {
            totalSize += histoireImages[i].size;
          }
          if (totalSize > 50 * 1024 * 1024) {
            shouldShowProgress = true;
          }
        }
        
        if (shouldShowProgress) {
          const $button = $(this).find('button[type="submit"]');
          const $progress = $('.upload-progress');
          
          // Désactiver le bouton et afficher la progression
          $button.prop('disabled', true).html(`
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Téléchargement en cours...
          `);
          
          $progress.removeClass('hidden');
          
          // Simuler une progression (dans un vrai cas, utilisez XMLHttpRequest avec progress)
          let progress = 0;
          const interval = setInterval(() => {
            progress += Math.random() * 10;
            if (progress > 90) progress = 90;
            
            $progress.find('.bg-primary-600').css('width', progress + '%');
            $progress.find('p').text(`Téléchargement... ${Math.round(progress)}%`);
            
            if (progress >= 90) {
              clearInterval(interval);
              $progress.find('p').text('Finalisation...');
            }
          }, 500);
        }
      });
    });
  </script>
  <title>Soumission d'histoire - PlumeUP</title>
</head>
<body class="bg-gray-50 min-h-screen">
  <!-- Navbar -->
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
  <!-- Main Content -->
  <main class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Publier votre histoire</h1>
      <p class="text-gray-600">Partagez votre création avec la communauté PlumeUP</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <form action="{{ route('histoirenregistrer') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf

        <!-- Titre -->
        <div>
          <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
            Titre de l'histoire
          </label>
          <input type="text" id="nom" name="titre" value="{{ old('titre') }}" 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition-colors" 
            placeholder="Entrez le titre de votre histoire" required />
          @error('titre')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Type -->
        <div>
          <label for="book" class="block text-sm font-medium text-gray-700 mb-2">
            Catégorie
          </label>
          <select id="book" name="type" 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition-colors" 
            required>
            <option value="">Sélectionner une catégorie</option>
            <option value="Aventure & Action" {{ old('type') == 'Aventure & Action' ? 'selected' : '' }}>Aventure & Action</option>
            <option value="Romance" {{ old('type') == 'Romance' ? 'selected' : '' }}>Romance</option>
            <option value="Fantastique & Fantasy" {{ old('type') == 'Fantastique & Fantasy' ? 'selected' : '' }}>Fantastique & Fantasy</option>
            <option value="Science-Fiction" {{ old('type') == 'Science-Fiction' ? 'selected' : '' }}>Science-Fiction</option>
            <option value="Horreur & Suspense" {{ old('type') == 'Horreur & Suspense' ? 'selected' : '' }}>Horreur & Suspense</option>
            <option value="Policier & Mystère" {{ old('type') == 'Policier & Mystère' ? 'selected' : '' }}>Policier & Mystère</option>
            <option value="Drame & Réalisme" {{ old('type') == 'Drame & Réalisme' ? 'selected' : '' }}>Drame & Réalisme</option>
            <option value="Historique" {{ old('type') == 'Historique' ? 'selected' : '' }}>Historique</option>
            <option value="Jeunesse & Contes" {{ old('type') == 'Jeunesse & Contes' ? 'selected' : '' }}>Jeunesse & Contes</option>
            <option value="Poèmes & Textes courts" {{ old('type') == 'Poèmes & Textes courts' ? 'selected' : '' }}>Poèmes & Textes courts</option>
            <option value="Bande dessinée & Webtoon" {{ old('type') == 'Bande dessinée & Webtoon' ? 'selected' : '' }}>Bande dessinée & Webtoon</option>
            <option value="Fanfiction & Univers dérivés" {{ old('type') == 'Fanfiction & Univers dérivés' ? 'selected' : '' }}>Fanfiction & Univers dérivés</option>
          </select>
          @error('type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Image de couverture -->
        <div>
          <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-2">
            Image de couverture
          </label>
          <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-400 transition-colors">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="text-sm text-gray-600">
              <label for="profile_image" class="relative cursor-pointer font-medium text-primary-600 hover:text-primary-500">
                <span>Choisir un fichier</span>
                <input id="profile_image" name="photos" type="file" class="sr-only" accept="image/*">
              </label>
              <span class="ml-1">ou glisser-déposer</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF jusqu'à 10MB</p>
            <span class="file-name hidden mt-2 text-sm text-primary-600 font-medium"></span>
          </div>
          @error('photos')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Fichier de l'histoire (pour les documents) -->
        <div id="document-field">
          <label for="histoire" class="block text-sm font-medium text-gray-700 mb-2">
            Fichier de l'histoire
          </label>
          <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-400 transition-colors">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <div class="text-sm text-gray-600">
              <label for="histoire" class="relative cursor-pointer font-medium text-primary-600 hover:text-primary-500">
                <span>Choisir votre histoire</span>
                <input id="histoire" name="histoire" type="file" class="sr-only" required 
                       accept=".doc,.docx,.pdf,.txt,.rtf,.odt">
              </label>
              <span class="ml-1">ou glisser-déposer</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">DOC, PDF, TXT jusqu'à 1GB</p>
            <span class="file-name hidden mt-2 text-sm text-primary-600 font-medium"></span>
          </div>
          @error('histoire')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Images de l'histoire (pour les BD et Webtoons) -->
        <div id="image-field" class="hidden">
          <label for="histoire_images" class="block text-sm font-medium text-gray-700 mb-2">
            Images de votre bande dessinée/webtoon
          </label>
          <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-400 transition-colors">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div class="text-sm text-gray-600">
              <label for="histoire_images" class="relative cursor-pointer font-medium text-primary-600 hover:text-primary-500">
                <span>Choisir vos images</span>
                <input id="histoire_images" name="histoire_images[]" type="file" class="sr-only" accept="image/*" multiple>
              </label>
              <span class="ml-1">ou glisser-déposer</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF - Plusieurs fichiers acceptés - 50MB au total</p>
            <p class="text-xs text-gray-400 mt-1">Sélectionnez toutes vos planches dans l'ordre de lecture</p>
            <span class="file-name hidden mt-2 text-sm text-primary-600 font-medium"></span>
          </div>
          @error('histoire_images')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Mode de diffusion -->
        <div>
          <label for="mode" class="block text-sm font-medium text-gray-700 mb-2">
            Mode de publication
          </label>
          <select id="mode" name="mode" 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition-colors" 
            required>
            <option value="">Sélectionner le mode de publication</option>
            <option value="Par chapitres ou tomes" {{ old('mode') == 'Par chapitres ou tomes' ? 'selected' : '' }}>Par chapitres ou tomes</option>
            <option value="En une seule fois" {{ old('mode') == 'En une seule fois' ? 'selected' : '' }}>En une seule fois</option>
          </select>
          @error('mode')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Information pour gros fichiers -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <div class="flex">
            <svg class="flex-shrink-0 h-5 w-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-blue-800">Information</h3>
              <p class="text-sm text-blue-700 mt-1">
                Les fichiers volumineux peuvent prendre plusieurs minutes à télécharger. Veuillez patienter sans fermer la page.
              </p>
            </div>
          </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="pt-4">
          <button type="submit" 
            class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            Publier l'histoire
          </button>
        </div>
      </form>
    </div>

    <!-- Footer info -->
    <div class="text-center mt-6 text-sm text-gray-500">
      <p>Tous les champs sont obligatoires • Fichiers jusqu'à 1GB acceptés</p>
    </div>
  </main>
</body>
</html>