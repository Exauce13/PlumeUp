<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageChapitre extends Model
{
    use HasFactory;
    protected $table = 'imageschapitres';
    protected $fillable = ['titre', 'numerochapitre', 'histoire_id', 'image_path', 'is_published'];
    public function histoire()
    {
        return $this->belongsTo(HistoireModel::class, 'histoire_id');
    }
}
