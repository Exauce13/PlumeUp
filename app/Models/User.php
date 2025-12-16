<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'pseudo',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function abonnements()
    {
        return $this->belongsToMany(User::class,'abonnement','subscriber_id','author_id')->withTimestamps()->where('users.statut', 'auteur'); // sécurité
    }
    public function abonnes()
    {
        return $this->belongsToMany(User::class, 'abonnement', 'author_id',  'subscriber_id')->withTimestamps();
    }
    public function scopeAuthors($query)
    {
        return $query->where('statut', 'auteur');
    }
    public function scopeReaders($query)
    {
        return $query->where('statut', 'Utilisateur');
    }

}
