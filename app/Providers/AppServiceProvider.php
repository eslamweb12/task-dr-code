<?php

namespace App\Providers;
use App\Models\AuthrizedPerson;
use App\Models\Branch;
use App\Models\Child;
use App\Policies\AuthrizedPersonPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     */
    public function register(): void
    {
        // ✅ Bind Firebase Messaging
       
    }

    /**
     * Bootstrap any application Services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: Str::random(40));
        });
    }
        
}
