<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AbonnementController extends Controller
{
    //  S'abonner à un auteur
    public function subscribe($authorId)
    {
        $subscriber = Auth::user();
        $author = User::where('id', $authorId)
                      ->where('statut', 'auteur')
                      ->firstOrFail();

        //Interdire auto-abonnement
        if ($subscriber->id === $author->id) {
            return back()->with('error', 'Auto-abonnement interdit.');
        }

        // Vérifier s'il est déjà abonné
        if (!$subscriber->abonnements()->where('author_id', $authorId)->exists()) {
            $subscriber->abonnements()->attach($authorId);
        }

        return back()->with('success', 'Vous suivez maintenant cet auteur.');
    }

    public function unsubscribe($authorId)
    {
        Auth::user()->abonnements()->detach($authorId);

        return back()->with('success', 'Désabonnement effectué.');
    }


}
