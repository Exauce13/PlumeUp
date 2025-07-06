<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('SuperAdmin', function(User $user){
            return $user->statut === 'SuperAdmin';
        });
        Gate::define(1, function ($user) {
            return $user->is_suspended == 1;
        });
        Gate::define('envoyermessage', function (User $from, $toId) {
            // Bloquer s’il essaie de s’envoyer un message
            if ($from->id == $toId) {
                return false;
            }
            // Vérifier si l’utilisateur connecté est ami avec le destinataire
            return $from->where('is_friends', 1)->exists();
        });
    }
}
