<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoireModel;
use App\Http\Requests\InscriptionRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\SuspensionMail;
use App\Mail\ReactiverMail;
use App\Models\CommentaireModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class AdminController extends Controller
{
    public function page()
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        return view('superadmin.admin');
    }
    public function histoirelistes()
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $hist = HistoireModel::all();
        return view('superadmin.listehistoire', [
            'histore' => $hist
        ]);
    }
    public function Userlistes()
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $users = User::all();
        return view('superadmin.listeutilisateur', [
            'utilisateur' => $users
        ]);
    }
    public function suspend($id)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $user = User::where('id', $id)->firstOrFail();
        $user->is_suspended = true;
        $user->save();
        Mail::to($user->email)->send(new SuspensionMail($user));
        return redirect()->back()->with('success', 'Utilisateur suspendu.');
    }
    public function reactivate($id)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $user = User::where('id', $id)->firstOrFail();
        $user->is_suspended = false;
        $user->save();
        Mail::to($user->email)->send(new ReactiverMail($user));
        return redirect()->back()->with('success', 'Utilisateur réactivé.');
    }
    public function modifier(User $users)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        return view('Superadmin.modification', [
            'user' => $users
        ]);
    }
    public function modifie(InscriptionRequest $request, User $user)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $user->name = $request->nom;
        $user->email = $request->email;
        $user->pseudo = $request->pseudos;
        $user->statut = $request->statut;
        $user->save();
        return redirect()->back();
    }
    public function delete(User $user)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $user->delete();
        return back();
    }
    public function commentaire(HistoireModel $histoire)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $comments = CommentaireModel::where('histoire_id', $histoire->id)->get();
        return view('Superadmin.comments', [
            'comment' => $comments
        ]);
    }
    public function deletehistoire(HistoireModel $histoires)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $histoires->delete();
        return back();
    }
    public function recherusers(Request $request)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $query = $request->input('query');
        $users = User::where('name', 'like', '%' . $query . '%')->orWhere('pseudo', 'like', '%' . $query . '%')->paginate(20);
        return view('Superadmin.husers', [
            'users' => $users
        ]);
    }
    public function recheristoire(Request $request)
    {
        if (!Auth::check() || !Gate::allows('SuperAdmin')) {
            abort(403); // Interdit l'accès si l'utilisateur n'est pas connecté ou n'est pas superAdmin
        }
        $query = $request->input('query');
        $histoire = HistoireModel::where('titre_book', 'like', '%' . $query . '%')->orWhere('type_book', 'like', '%' . $query . '%')->paginate(20);
        return view('Superadmin.chistoire', [
            'histoires' => $histoire
        ]);
    }

}
