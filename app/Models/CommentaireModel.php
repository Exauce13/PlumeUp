<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentaireModel extends Model
{
    protected $table = 'commentaires';
    protected $fillable = ['user_id', 'histoire_id', 'comment', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function histoire()
    {
        return $this->belongsTo(HistoireModel::class);
    }
    public function children()
    {
        return $this->hasMany(CommentaireModel::class, 'parent_id')->latest();
    }
    public function parent()
    {
        return $this->belongsTo(CommentaireModel::class, 'parent_id');
    }

}
