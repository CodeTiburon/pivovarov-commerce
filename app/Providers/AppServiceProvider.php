<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);

        $this->app->singleton('auth', function($app)
        {
            $app['auth.loaded'] = true;
            return new \App\Services\AuthManager($app);
        });

        $this->app->singleton('RenderTree', function($app)
        {
            return new \App\Services\RenderCategoriManager($app);
        });

        $this->app->singleton('ProductManager', function($app)
        {
            return new \App\Services\ProductManager($app);
        });
        $this->app->singleton('OrderManager', function($app)
        {
            return new \App\Services\OrderManager($app);
        });
	}

}
