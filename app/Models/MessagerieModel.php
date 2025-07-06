<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagerieModel extends Model
{
    protected $table = 'messageries';
    protected $fillable = ['from_id', 'to_id', 'content', 'read_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    /*public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }*/


}
