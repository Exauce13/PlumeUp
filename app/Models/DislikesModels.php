<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DislikesModels extends Model
{
    protected $table = 'dislikes';
    protected $fillable = ['user_id', 'histoire_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function histoire()
    {
        return $this->belongsTo(HistoireModel::class, 'histoire_id');
    }
}
