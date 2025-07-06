<?php

namespace App\Http\Controllers;

use App\Models\HistoireModel;
use App\Models\CommentaireModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentaireController extends Controller
{
    #la méthode permettant d'afficher les différents commentaires sur un livre
    public function affichercommentaire(HistoireModel $histoire)
    {
        Gate::define(1, function ($user) {
            return $user->is_suspended == 1;
            abort(403);
        });
        $commentaires = $histoire->commentaires()->with(['user', 'children.user'])->whereNull('parent_id')->latest()->get();
        return view('commentaires',compact('histoire', 'commentaires'));
    }
    # la méthode qui gère commment poster un commentaire
    public function postercommentaire(Request $request)
    {
        Gate::define(1 , function ($user) {
            return $user->is_suspended == 1;
            abort(403);
        });
        $valide=$request->validate([
            'content' => 'required|string|max:1500',
        ]);
        CommentaireModel::create([
            'comment'=>$valide['content'],
            'user_id'=>Auth::id(),
            'histoire_id'=>$request->histoire_id,
        ]);
        return back()->with('success', 'Commentaire poster');
    } 
    /*la méthode qui permet de répondre à un commentaire déjà poster
    public function repondrecommentaire(CommentaireModel $parent, Request $request)
    {
        $valider = $request->validate([
            'content'=>'required|string|max:1500'
        ]);
        CommentaireModel::create([
            'comment'=>$valider['content'],
            'user_id'=>Auth::id(),
            'book_id'=>$parent->book_id,
            'parent_id'=>$parent->id,
        ]);
        return back();
    }*/
}
