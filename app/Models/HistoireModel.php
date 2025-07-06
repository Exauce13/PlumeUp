<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoireModel extends Model
{
    protected $table = 'histoire';
    protected $fillable = [
        'user_id',
        'titre_book', 
        'type_book', 
        'url_book',
        'photos',
        'modediffusion',
        'album',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
        public function commentaires()
    {
        return $this->hasMany(CommentaireModel::class, 'histoire_id');
    }
    public function likes()
    {
        return $this->hasMany(LikesModels::class, 'histoire_id');
    }
    public function dislikes()
    {
        return $this->hasMany(DislikesModels::class, 'histoire_id');
    }
    public function chapdiffusion()
    {
        return $this->hasMany(ChapitreModel::class, 'histoire_id');
    }
    public function imageschapitres()
    {
        return $this->hasMany(ImageChapitre::class, 'histoire_id');
    }
    public function nbrlecture()
    {
        return $this->hasMany(LireModel::class, 'histoire_id');
    }

}
