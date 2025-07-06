<?php

namespace App\Http\Controllers;

use App\Models\ChapitreModel;
use App\Models\ImageChapitre;
use App\Models\HistoireModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HistoireController extends Controller
{
    // Optionnel : petit helper pour vérifier si c’est du JSON
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function pagehistoire()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        return view('Auteurs.histoires');
    }
    //la méthode permet d'enregistrer une histoire
    public function enregistrer(HistoireModel $histoire, Request $request)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $request->validate([
            'titre' => 'required|string|max:255',
            'histoire' => 'nullable|mimes:pdf,doc,docx,cbr,cbz,zip|max:5024000',
            'type' => 'required|string|in:Aventure & Action,Romance,Fantastique & Fantasy,Science-Fiction,Horreur & Suspense,Policier & Mystère,Drame & Réalisme,Historique,Jeunesse & Contes,Poèmes & Textes courts,Bande dessinée & Webtoon,Fanfiction & Univers dérivés',
            'photos' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:102400',
            'mode' => 'required|string|in:Par chapitres ou tomes,En une seule fois',
            'histoire_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:51200',
        ]);
        // Image de couverture
        $photoPath = null;
        if ($request->hasFile('photos')) {
            if ($histoire->photos && Storage::disk('public')->exists($histoire->photos)) {
                Storage::disk('public')->delete($histoire->photos);
            }
            $photoPath = $request->file('photos')->store('photos', 'public');
        }
        // Traitement des images multiples
        // 📂 Traitement des images multiples à stocker dans "album" (CSV)
        $album = null;
        if ($request->hasFile('histoire_images')) {
            $images = [];
            foreach ($request->file('histoire_images') as $img) {
                $images[] = $img->store('webtoon_images', 'public');
            }
            // Limite à 12 images
            if (count($images) > 12) {
                return back()->withErrors(['images' => 'Maximum 12 images par chapitre']);
            }
            // Implode des chemins (ex: "img1.jpg,img2.jpg,img3.jpg")
            $album = implode(',', $images);
        }
        // Traitement selon le type
        $urlbook = null;
        if ($request->type !== 'Bande dessinée & Webtoon' && $request->hasFile('histoire')) {
            $urlbook = $request->file('histoire')->store('histoire', 'public');
        }
        // Création en base de données
        HistoireModel::create([
            'user_id' => Auth::id(),
            'titre_book' => $request->titre,
            'type_book' => $request->type,
            'url_book' => $urlbook,
            'album' => $album, // Stockage en chaîne CSV
            'photos' => $photoPath,
            'modediffusion' => $request->mode,
        ]);
        return back()->with('success', 'Enregistrement réussi');
    }
    public function publierChapitre(Request $request)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }    
        // Validation du fichier chapitre
        $request->validate([
            'titre' => 'required|string|max:255',
            'numero' => 'required',
            'fichier' => 'required|mimes:pdf,doc,docx,cbr,cbz,zip|max:5024000',
        ]);
        // Stockage du fichier
        $fichier = $request->file('fichier');
        $cheminFichier = $fichier->store('chapitres', 'public');
        // Création du chapitre lié à l’histoire
        ChapitreModel::create([
            'histoire_id' => $request->histoire_id,
            'titre_chapitre' => $request->titre,
            'numerochapitre' => $request->numero,
            'url_chapitre' => $cheminFichier,
            'is_published' => true, // facultatif si tu veux gérer publication manuelle
        ]);
        return back()->with('success', 'Chapitre publié avec succès.');
    }
    #Permet d'afficher le premier chapitre de l'oeuvre
    public function voir(HistoireModel $histoire)
    {
        $images = [];
        if (!empty($histoire->album)) {
            $images = array_map('trim', explode(',', $histoire->album));
        }
        //dd($images);
        return view('Users.visuels', [
            'images' => $images,
            'histoire' => $histoire,
        ]);
    }

    public function aventureaction()
    {
       if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Aventure & Action')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function romance()
    {
        if (!Auth::check() ||Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Romance')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function fantastique()
    {
       if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Fantastique & Fantasy')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function fiction()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Science-Fiction')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function horreur()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Horreur & Suspense')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function policier()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Policier & Mystère')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function drame()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Drame & Réalisme')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function historique()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Historique')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function contes()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Jeunesse & Contes')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function poemes()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Poèmes & Textes courts')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function dessin()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Bande dessinée & Webtoon')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function fanfiction()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $rechercheaa = HistoireModel::where('type_book', 'Fanfiction & Univers dérivés')->with(['likes', 'dislikes'])->get();
        return view('users.lectures', ['history' => $rechercheaa]);
    }
    public function listehistoire()
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $recherche = HistoireModel::where('user_id', Auth::id())->get();
        return view('auteurs.catalogue', [
            'meshistoires' => $recherche
        ]);
    }
    public function formchapitre(HistoireModel $histoirechap)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        return view('createchapitre', [
            'histoires' => $histoirechap
        ]);
    }
    public function vuechapitre(HistoireModel $histoire)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $chaps = ChapitreModel::where('histoire_id', $histoire->id)->get();
        return view('Users.chapitres' , [
            'tomes' => $chaps
        ]);
    }
    public function searchistoire(Request $request)
    {
        $query = $request->input('query');
        $histoire = HistoireModel::where('titre_book', 'like', '%' . $query . '%')->orWhere('type_book', 'like', '%' . $query . '%')->paginate(20);
        return view('searchistoire', [
            'histoires' => $histoire
        ]);
    }
    #méthode qui permet d'enregistrer les images des webtons
    public function Webbdchapitre(HistoireModel $histoirewebd)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        return view('Auteurs.webtoonsbdchapitre', [
            'histoires' => $histoirewebd
        ]);
    }
    public function storewebd(Request $request)
    {
        $request->validate([
            'titre' => 'required|string',
            'numero' => 'required|integer',
            'images.*' => 'required|image|max:2048',
        ]);
        // 📂 Traitement des images multiples à stocker dans "album" (CSV)
        $images = null;
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('webdchapitres', 'public');
            }
            // Limite à 12 images
            if (count($images) > 12) {
                return back()->withErrors(['images' => 'Maximum 12 images par chapitre']);
            }
            // Implode des chemins (ex: "img1.jpg,img2.jpg,img3.jpg")
            $path = implode(',', $images);
            ImageChapitre::create([
                'histoire_id' => $request->histoire_id,
                'titre' => $request->titre,
                'numerochapitre' => $request->numero,
                'image_path' => $path,
                'is_published' => true,
            ]);
        }
        
        return back();
    }
    public function imgchapitre(HistoireModel $histoire)
    {
        if (!Auth::check() || Gate::allows(1)) {
            abort(403);
        }
        $chap = ImageChapitre::where('histoire_id', $histoire->id)->get();
        return view('Auteurs.webdvisuel' , [
            'tome' => $chap
        ]);
    }
    public function visuelimg(ImageChapitre $img)
    {
        $images = [];
        if (!empty($img->image_path)) {
            $images = array_map('trim', explode(',',$img->image_path));
        }
        //dd($images);
        return view('Auteurs.visuel', [
            'images' => $images,
            'img' => $img,
        ]);
    }


}
