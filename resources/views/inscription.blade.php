<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulaire Utilisateur</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Créer un compte</h2>

    <form action="{{ route('insertion') }}" method="POST" class="space-y-4">
      @method('post')
      @csrf
      
      <div>
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" id="nom" name="nom" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        <div>
          @error('nom')
          <p class="text-red-500 text-sm mt-1">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        <div>
          @error('email')
          <p class="text-red-500 text-sm mt-1">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div>
        <label for="pseudos" class="block text-sm font-medium text-gray-700">Pseudos</label>
        <input type="text" id="pseudos" name="pseudos" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        <div>
          @error('pseudos')
          <p class="text-red-500 text-sm mt-1">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" id="password" name="password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        <div>
          @error('password')
          <p class="text-red-500 text-sm mt-1">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div>
        <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
        <select id="statut" name="statut" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          <option value="">-- Sélectionnez un statut --</option>
          <option value="utilisateur" {{ (old('statut', $user->statut ?? '') === 'utilisateur') ? 'selected' : '' }}>Utilisateur</option>
          <option value="auteur" {{ (old('statut', $user->statut ?? '') === 'auteur') ? 'selected' : '' }}>Auteur</option>
        </select>
        <div>
          @error('statut')
          <p class="text-red-500 text-sm mt-1">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div class="flex items-start">
        <input type="checkbox" id="cgu" name="cgu" class="mt-1 mr-2" required {{ old('cgu') ? 'checked' : '' }}>
        <label for="cgu" class="text-sm text-gray-700">
          J'accepte les <a href="{{ route('contrat') }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">conditions d'utilisation et contrats</a>.
        </label>
      </div>
      @error('cgu')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror

      <div class="pt-2">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200">
          S'inscrire
        </button>
      </div>
    </form>
    
    <!-- Section de connexion séparée du formulaire -->
    <div class="mt-6 pt-4 border-t border-gray-200">
      <p class="text-center text-gray-600 text-sm mb-3">
        Déjà un compte ? Connectez-vous plus facilement
      </p>
      <a href="{{ route('log') }}" class="block w-full px-6 py-3 border border-amber-500 text-amber-500 font-semibold rounded-xl hover:bg-amber-500 hover:text-white transition duration-200 text-center">
        Connexion
      </a>
    </div>
  </div>

</body>
</html>