<?php

namespace App\Providers;

use App\Repositories\IEditoraRepository;
use App\Repositories\IPublicacaoRepository;
use App\Repositories\EditoraRepository;
use App\Repositories\PublicacaoRepository;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('pt_BR');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
