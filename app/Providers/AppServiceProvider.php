<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\User;
use App\Policies\ContactPolicy;
use Illuminate\Support\ServiceProvider;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Gate::define('update-contact', function (User $user, Contact $contact) {
         return $user->id === $contact->user_id;
    });
        Gate::define('view-contact', [ContactPolicy::class, 'view']);
        Gate::define('create-contact',[ContactPolicy::class, 'create']);
        Gate::define('delete-contact',[ContactPolicy::class, 'delete']);
    }
}
