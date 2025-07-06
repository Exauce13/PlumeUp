<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\MessagerieModel;
use App\Models\FriendModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function isfriends($id)
    {
        $destinataire = User::findOrFail($id);
        $existe = FriendModel::where(function ($query) use ($destinataire) {
            $query->where('expediteur', Auth::id())->where('destinataire', $destinataire->id);
        })->orWhere(function ($query) use ($destinataire) {
            $query->where('expediteur', $destinataire->id)->where('destinataire', Auth::id());
        })->exists();
        if ($existe) {
            return back()->with('message', 'Une demande d’amitié existe déjà.');
        }
        FriendModel::create([
            'expediteur' => Auth::id(),
            'destinataire' => $destinataire->id,
            'is_friends' => false, // en attente de validation
        ]);
        return back()->with('message', 'Demande d’amitié envoyée.');
    }
    public function acceptRequest($id)
    {
        $demande = FriendModel::where('expediteur', $id)->where('destinataire', Auth::id())->where('is_friends', false)->firstOrFail();
        $demande->update(['is_friends' => true]);
        return back()->with('message', 'Demande acceptée.');
    }
    public function refuseRequest($id)
    {
        $demande = FriendModel::where('expediteur', $id)->where('destinataire', Auth::id())->where('is_friends', false)->first();
        if ($demande) {
            $demande->delete();
        }

        return back()->with('message', 'Demande refusée.');
    }

    /**
     * Supprimer un ami
     */
    public function deleteFriend($id)
    {
        $relation = FriendModel::where(function ($query) use ($id) {
            $query->where('expediteur', Auth::id())->where('destinataire', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('expediteur', $id)->where('destinataire', Auth::id());
        })->where('is_friends', true)->first();

        if ($relation) {
            $relation->delete();
        }

        return back()->with('message', 'Ami supprimé.');
    }

    #Afficher les amis et demandes
    public function index()
    {
        $user = Auth::user();

        $amis = FriendModel::where(function ($query) use ($user) {
            $query->where('expediteur', $user->id)->orWhere('destinataire', $user->id);
        })->where('is_friends', true)->get();

        $demandesEnvoyees = FriendModel::where('expediteur', $user->id)->where('is_friends', false)->get();

        $demandesRecues = FriendModel::where('destinataire', $user->id)->where('is_friends', false)->get();

        return view('index', compact('amis', 'demandesEnvoyees', 'demandesRecues'));
    }
    /*public function searchfriends(Request $request)
    {
        $query = $request->input('query');
        $friends = FriendModel::where('name', 'like', '%' . $query . '%')->orWhere('pseudo', 'like', '%' . $query . '%')->paginate(6);
        return view('searchfriends', [
            'users' => $friends
        ]);
    }*/
}
