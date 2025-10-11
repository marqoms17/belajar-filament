<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();
        Gate::before(function ($user, $ability) {
            return $user->is_admin ? true : null;
        });
    }

    protected $policies = [
        \App\Models\Patient::class   => \App\Policies\PatientPolicy::class,
        \App\Models\Owner::class     => \App\Policies\OwnerPolicy::class,
        \App\Models\Treatment::class => \App\Policies\TreatmentPolicy::class,
        \App\Models\Tool::class      => \App\Policies\ToolPolicy::class,
        \App\Models\Customer::class      => \App\Policies\CustomerPolicy::class,
        // tambah model lain jika ada
    ];
}
