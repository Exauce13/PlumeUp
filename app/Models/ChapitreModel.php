<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapitreModel extends Model
{
    protected $table = 'chapdiffusion';
    protected $fillable = ['histoire_id','titre_chapitre',
        'url_chapitre', 'is_published', 'numerochapitre',
    ];
    public function histoire()
    {
        return $this->belongsTo(HistoireModel::class, 'histoire_id');
    }
}
