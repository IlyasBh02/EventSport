<?php

namespace App\Providers;

use App\Models\Matchs;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Explicit binding because 'match' is a reserved PHP keyword
        Route::model('match', Matchs::class);
    }
}
