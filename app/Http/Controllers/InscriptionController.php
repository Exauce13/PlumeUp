<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\InscriptionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function inscription()
    {
        return view('inscription');
    }
    public function enregistrement(User $user, InscriptionRequest $request)
    {
        $user->name = $request->nom;
        $user->email = $request->email;
        $user->pseudo = $request->pseudos;
        $user->password = Hash::make($request->password);
        $user->statut = $request->statut;
        $user->save();
        return redirect()->route('views');
    }
    public function login()
    {
        return view('connexion');
    }
    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        $credentials = $request-> validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials))
        {
            $request -> session()->regenerate();
            return redirect()->intended('accueil');
        }
        return back()->withErrors(['email'=> 'Email erronée',])->onlyInput('email');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('views');
    }
    public function contrat()
    {
        return view('users.contrat');
    }
    public function photoprofile()
    {
       if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $users = User::where('id', '!=', Auth::id())->whereNotIn('id', function($query) {
            #cette requête permet de récupérer la liste des personnes qui sont pas amis avec  un destinataire 
            $query->select('destinataire')->from('friends')->where('expediteur', Auth::id())->where('is_friends', 1);
        })->whereNotIn('id', function($query) {
            #cette requête permet de récupérer la liste des personnes qui sont pas amis avec un expéditeur
            $query->select('expediteur')->from('friends')->where('destinataire', Auth::id())->where('is_friends', 1);
        })->get(['id', 'name', 'pseudo', 'avatar']);
        return view('profile', [
            'utilisateurs' => $users
        ]);
    }
    public function changementprofile(Request $request)
    {
        if (!Auth::check() ||Gate::allows(1)) {
            abort(403);
        }
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:102400',
        ]);
        /** @var \App\Models\User $user */# C'est un  PHPDoc pour indiquer à Intelephense le type de $user.
        $user = Auth::user(); 
        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'ben-sweet-2LowviVHZ-E-unsplash.jpg' && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }
        $user->save();
        return back()->with('success', 'Profil modifié avec succès.');
    }
    public function searchusers(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', '%' . $query . '%')->orWhere('pseudo', 'like', '%' . $query . '%')->paginate(20);
        return view('searchusers', [
            'users' => $users
        ]);
    }


}
