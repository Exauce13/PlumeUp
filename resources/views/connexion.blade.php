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
    
    <form action="{{ route('valider') }}" method="POST" class="space-y-4">
      @method('post')
      @csrf
      
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
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" id="password" name="password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        <div>
          @error('password')
          <p class="text-red-500 text-sm mt-1">{{$message}}</p>
          @enderror
        </div>
      </div>
      
      <div class="pt-2">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200">
          Se connecter
        </button>
      </div>
    </form>
    
    <!-- Section d'inscription séparée du formulaire -->
    <div class="mt-6 pt-4 border-t border-gray-200">
      <p class="text-center text-gray-600 text-sm mb-3">
        Vous n'avez pas de compte ?
      </p>
      <a href="{{ route('enregistrer') }}" class="block w-full px-6 py-3 border border-amber-500 text-amber-500 font-semibold rounded-xl hover:bg-amber-500 hover:text-white transition duration-200 text-center">
        S'inscrire
      </a>
    </div>
  </div>
</body>
</html>