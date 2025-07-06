<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes relations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 p-6">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">👥 Gestion des amis</h1>

        {{-- ✅ Amis --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-3">Mes amis</h2>
            @if($amis->count())
                <ul class="space-y-2">
                    @foreach($amis as $ami)
                        @php
                            $amiUser = $ami->expediteur == auth()->id() ? $ami->destinataire : $ami->expediteur;
                            $userAmi = \App\Models\User::find($amiUser);
                        @endphp
                        <li class="flex items-center justify-between bg-gray-50 p-3 rounded">
                            <span>{{ $userAmi->name }}</span>
                            <form method="POST" action="{{ route('friends.delete', $userAmi->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Supprimer cet ami ?')">Supprimer</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucun ami pour l’instant.</p>
            @endif
        </div>

        {{-- 📤 Demandes envoyées --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-3">Demandes envoyées</h2>
            @if($demandesEnvoyees->count())
                <ul class="space-y-2">
                    @foreach($demandesEnvoyees as $demande)
                        @php $userDemande = \App\Models\User::find($demande->destinataire); @endphp
                        <li class="bg-gray-50 p-3 rounded">{{ $userDemande->name }} <span class="text-sm text-gray-500">(En attente)</span></li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucune demande envoyée.</p>
            @endif
        </div>

        {{-- 📥 Demandes reçues --}}
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-3">Demandes reçues</h2>
            @if($demandesRecues->count())
                <ul class="space-y-4">
                    @foreach($demandesRecues as $demande)
                        @php $userExp = \App\Models\User::find($demande->expediteur); @endphp
                        <li class="flex items-center justify-between bg-gray-50 p-3 rounded">
                            <span>{{ $userExp->name }}</span>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('friends.accept', $userExp->id) }}">
                                    @csrf
                                    <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Accepter</button>
                                </form>
                                <form method="POST" action="{{ route('friends.refuse', $userExp->id) }}">
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Refuser</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucune demande reçue.</p>
            @endif
        </div>
    </div>

</body>
</html>
