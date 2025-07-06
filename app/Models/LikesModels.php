<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikesModels extends Model
{
    protected $table = 'likes';
    protected $fillable = [
        'user_id', 
        'histoire_id',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function histoire()
    {
        return $this->belongsTo(HistoireModel::class, 'histoire_id');
    }
}
