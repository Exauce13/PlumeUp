<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-md py-4 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto flex items-center justify-between px-4">
            <div class="flex items-center space-x-3">
                <i class="fas fa-comments text-blue-600 text-2xl"></i>
                <h1 class="text-xl font-bold text-gray-800">Messagerie PlumeUP</h1>
            </div>
            <a href="{{ route('listesd') }}" class="text-sm text-blue-600 hover:underline font-medium">Retour à la discussion</a>
            <div class="flex items-center gap-2">
                <img src="{{ asset('storage/'. $receiver->avatar) }}" alt="Avatar" class="rounded-full w-9 h-9 object-cover shadow ring-2 ring-blue-400">
                <p class="font-semibold text-gray-700">{{ $receiver->name }}</p>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="flex-1 w-full max-w-4xl mx-auto flex flex-col bg-gray-50">
        
        
        <!-- Zone des messages -->
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-4" id="messagesContainer">
            @forelse($messages as $message)
                <div class="flex {{ $message->from_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-xs md:max-w-md px-4 py-3 rounded-2xl shadow 
                        {{ $message->from_id == auth()->id() ? 'bg-blue-600 text-white' : 'bg-white text-gray-800' }}">
                        <p class="text-sm font-semibold mb-1">
                            {{ $message->user->name }}
                        </p>
                        <p class="text-sm">{{ $message->content }}</p>
                        <p class="text-xs mt-2 text-right opacity-60">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 mt-10">
                    <i class="fas fa-inbox text-4xl mb-3"></i>
                    <p class="text-lg">Aucun message</p>
                    <p class="text-sm text-gray-400">Commence la discussion en envoyant un message</p>
                </div>
            @endforelse
        </div>

        <!-- Formulaire d’envoi -->
        <form id="message-form" action="{{ route('envoiemessage', $receiver->id) }}" method="POST" class="border-t bg-white px-4 py-4 shadow-inner">
            @csrf
            <div class="flex items-center gap-3">
                <textarea id="messageInput" name="content" rows="1" required placeholder="Écrire un message..."
                          class="flex-1 resize-none border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"></textarea>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full flex items-center gap-2 shadow transition">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer
                </button>
            </div>
        </form>
    </div>
    <script>
    setInterval(()=>{
        location.reload();
    },60000);
</script>
</body>
</html>