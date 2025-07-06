<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendModel extends Model
{
    protected $table = 'friends';
    protected $fillable = ['expediteur', 'destinataire', 'is_friends'];
}
