<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\HistoireController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\MessageriesController;
use App\Http\Requests\InscriptionRequest;
use App\Models\HistoireModel;
use App\Models\HistoireModels;
use App\Http\Middleware\Friends;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
})->name('views');
Route::middleware(['guest'])->group(function()
{
    Route::get('/formulaire', [InscriptionController::class, 'inscription'])->name('enregistrer');
    Route::post('/inscription', [InscriptionController::class, 'enregistrement'])->name('insertion');
    Route::get('/connexion', [InscriptionController::class, 'login'])->name('log');
    Route::post('/login', [InscriptionController::class, 'authenticate'])->name('valider');
    Route::get('/contrat', [InscriptionController::class, 'contrat'])->name('contrat');
});
Route::middleware(['auth'])->group(function(){
    Route::get('/accueil', function(){
        return view('Users.pageaccueil');
    })->name('accueil');
    Route::get('/deconnexion', [InscriptionController::class, 'logout'])->name('deconnexion');
    Route::get('/profile', [InscriptionController::class, 'photoprofile'])->name('profiles');
    Route::put('/update', [InscriptionController::class, 'changementprofile'])->name('photo');
    Route::get('/histoires', [HistoireController::class, 'pagehistoire'])->name('pghistoires');
    Route::post('/enregistrerhistoire',[HistoireController::class, 'enregistrer'])->name('histoirenregistrer');
    Route::get('/téléchargement', [HistoireController::class, 'téléchargerhistoire'])->name('télécharger');
    Route::get('/commentaire/{histoire}',[CommentaireController::class, 'affichercommentaire'])->name('pgcommentaire');
    Route::post('/postercommentaires', [CommentaireController::class, 'postercommentaire'])->name('poste');
    Route::post('/reponsecommentaires', [CommentaireController::class, 'repondrecommentaire'])->name('reponse');
    Route::post('/like/{histoireid}/like', [LikeDislikeController::class, 'like'])->name('like');
    Route::post('/dislike/{histoireid}/dislike', [LikeDislikeController::class, 'dislike'])->name('dislike');
    Route::get('/catalogue', [HistoireController::class, 'listehistoire'])->name('catalogues');
    Route::get('/formulairechapitre/{histoirechap}', [HistoireController::class,  'formchapitre'])->name('form');
    Route::post('/chapitre/diffusion', [HistoireController::class, 'publierChapitre'])->name('chapitre');
    Route::get('/listechap/{histoire}', [HistoireController::class, 'vuechapitre'])->name('chap');
    Route::get('/formulairewebd/{histoirewebd}', [HistoireController::class,  'Webbdchapitre'])->name('webdform');
    Route::post('/chapitre/diffusionBd', [HistoireController::class, 'storewebd'])->name('webd');
    Route::get('/Vue/{histoire}', [HistoireController::class,  'imgchapitre'])->name('imgchap');
    Route::get('/visuel/{img}', [HistoireController::class, 'visuelimg'])->name('voir');
    Route::get('/voirimages/{histoire}', [HistoireController::class, 'voir'])->name('vue');
    

    Route::prefix('lectures')->group(function(){
        Route::get('/', [HistoireController::class, 'aventureaction'])->name('actions');
        Route::get('/amour', [HistoireController::class, 'romance'])->name('romance');
        Route::get('/fantaisie', [HistoireController::class, 'fantastique'])->name('fantasy');
        Route::get('/science', [HistoireController::class, 'fiction'])->name('sciences');
        Route::get('/peur', [HistoireController::class, 'horreur'])->name('suspences');
        Route::get('/police', [HistoireController::class, 'policier'])->name('mystères');
        Route::get('/triste', [HistoireController::class, 'drame'])->name('realismes');
        Route::get('/long', [HistoireController::class, 'historique'])->name('historiques');
        Route::get('/raconte', [HistoireController::class, 'contes'])->name('jeunesses');
        Route::get('/flirt', [HistoireController::class, 'poemes'])->name('courtextes');
        Route::get('/cartoon', [HistoireController::class, 'dessin'])->name('webtoon');
        Route::get('/divers', [HistoireController::class, 'fanfiction'])->name('univers');
    });
    Route::prefix('admin')->group(function(){
            Route::get('/pages', [AdminController::class, 'page'])->name('yes');
            Route::get('/liste', [AdminController::class, 'histoirelistes'])->name('listes');
            Route::get('/listeuser', [AdminController::class, 'Userlistes'])->name('lusers');
            Route::get('/modifeinfo/{users}', [AdminController::class, 'modifier'])->name('info');//Le nom du paramètre {users} doit être identique à la variable mis en paramètre
            Route::post('/suspendre/{id}',[AdminController::class, 'suspend'])->name('susp');
            Route::post('/reactive/{id}', [AdminController::class, 'reactivate'])->name('reacte');
            Route::put('/formulaire/{user}/edit',[AdminController::class, 'modifie'])->name('modife');
            Route::delete('/suppression/{user}', [AdminController::class, 'delete'])->name('supprimer');
            Route::get('/comme/{histoire}', [AdminController::class, 'commentaire'])->name('affichecommentaire');
            Route::delete('/suppression/{histoires}', [AdminController::class, 'deletehistoire'])->name('suppression');
            Route::get('/usersrecherche', [AdminController::class, 'recherusers'])->name('userec');
            Route::get('/histoire', [AdminController::class, 'recheristoire'])->name('livres');
    });
    Route::prefix('messages')->group( function(){
        Route::get('/listediscussion', [MessageriesController::class, 'index'])->name('listesd');
        Route::get('/devenirami/{id}', [FriendsController::class, 'isfriends'])->name('futurpotes');
        Route::get('/friends', [FriendsController::class, 'index'])->name('friendsindex');
        Route::post('/friends/accept/{id}', [FriendsController::class, 'acceptRequest'])->name('friends.accept');
        Route::post('/friends/refuse/{id}', [FriendsController::class, 'refuseRequest'])->name('friends.refuse');
        Route::delete('/friends/delete/{id}', [FriendsController::class, 'deleteFriend'])->name('friends.delete');
        Route::get('/voirmessages/{user}', [MessageriesController::class, 'voirMessagesDeDiscussion'])->name('listemessages');
        Route::post('/message/{user}', [MessageriesController::class, 'messages'])->name('envoiemessage');
    });
    Route::prefix('search')->group(function(){
        Route::get('/users', [InscriptionController::class, 'searchusers'])->name('susers');
        Route::get('/histoire',[HistoireController::class, 'searchistoire'])->name('shistoire');
    });
});
