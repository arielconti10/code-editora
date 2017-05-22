<?php

namespace App\Providers;

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
        /**
         * Macro para criar verificação de erros
         */
        \Form::macro('error', function($field, $errors){
            if($errors->has($field)){
                return view('errors.error_field', compact('field'));
            }
            return null;
        });

        /**
         * Macro para criar form-group no HTML e validação de erros para o campo que está sendo criado
         */
        \Html::macro('openFormGroup', function($field = null, $errors = null){
            $hasError = ($field != null and $errors != null and $errors->has($field)) ? ' has-error' : '';
            return "<div class=\"form-group{$hasError}\">";
        });

        \Html::macro('closeFormGroup', function(){
           return "</div>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
