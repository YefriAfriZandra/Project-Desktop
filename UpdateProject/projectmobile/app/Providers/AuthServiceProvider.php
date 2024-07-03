<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('sistem', function (User $user) {
            return $user->role === 'sistem'; // sesuaikan dengan nilai yang sesuai untuk sistem
        });
    
        Gate::define('pembayaran', function (User $user) {
            return $user->role === 'pembayaran'; // sesuaikan dengan nilai yang sesuai untuk pembayaran
        });
    
        Gate::define('guru', function (User $user) {
            return $user->role === 'guru'; // sesuaikan dengan nilai yang sesuai untuk guru
        });
    
        Gate::define('siswa', function (User $user) {
            return $user->role === 'siswa'; // sesuaikan dengan nilai yang sesuai untuk siswa
        });
    }
}
