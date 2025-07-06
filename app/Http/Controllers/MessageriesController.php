<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\MessagerieModel;
use App\Models\FriendModel;
use Illuminate\Support\Facades\Auth;

use App\Repository\ConversationsRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as AuthManager; // ou use Illuminate\Auth\AuthManager;

class MessageriesController extends Controller
{
    #Elle permet d'afficher tous les personnes avec qui j'ai une discussion
    public function index()
    {
         $users = User::whereIn('id', function($query) {
            $query->select('destinataire')->from('friends')->where('expediteur', Auth::id())->where('is_friends', 1);})
            ->orWhereIn('id', function($query) {$query->select('expediteur')->from('friends')->where('destinataire', Auth::id())->where('is_friends', 1);
        })->get(['id', 'name', 'pseudo', 'avatar']);

        return view('MessageriePlumeUP.listesc', [
            'users' => $users
        ]);
    }
    public function voirMessagesDeDiscussion(User $user)
    {
        $authId = Auth::id();
        $receiverId = $user->id;
        // Récupère tous les messages entre l’utilisateur connecté et le destinataire
        $messages = MessagerieModel::where(function ($query) use ($authId, $receiverId) {
            $query->where('from_id', $authId)->where('to_id', $receiverId);
        })->orWhere(function ($query) use ($authId, $receiverId) {
            $query->where('from_id', $receiverId)->where('to_id', $authId);
        })->orderBy('created_at', 'asc')->get();
        // Liste des autres utilisateurs pour affichage éventuel
        $autresUsers = User::select('name', 'id')->where('id', '!=', $authId)->get();
        return view('MessageriePlumeUP.affichediscussion', [
            'messages' => $messages,
            'receiver' => $user,
            'autresUsers' => $autresUsers,
        ]);
    }
    public function messages(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000' 
        ]);
        MessagerieModel::create([
            'from_id' => Auth::id(),
            'to_id' => $user->id,
            'content' => $validated['content'],
        ]);
        return back();
    }

}
