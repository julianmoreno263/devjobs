<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

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
        Schema::defaultStringLength(191);

        VerifyEmail::toMailUsing(function($notifiable,$url){

            return (new MailMessage)
            ->subject('Verificar Cuenta')
            ->line('Tu cuenta está casi lista, solo debes presionar el enlace a continuación')
            ->action('Confirmar Cuenta',$url)
            ->line('Si no create esta cuenta puedes ignorar este mensaje');
        });
    }
}
