<?php

namespace FuquIo\LaravelPackage;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 * @package FuquIo\LaravelCors
 */
class ServiceProvider extends BaseServiceProvider{
	CONST SHORT_NAME = 'package';

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot(){

		$this->bootConfig();
		$this->bootMigrations();
		//$this->bootMiddleware();

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register(){

	}


	/**
	 * @internal
	 */
	private function bootConfig(){
		$this->publishes([__DIR__ . '/../config/main.php' => config_path(SELF::SHORT_NAME . '.php')]);
		$this->mergeConfigFrom(
			__DIR__ . '/../config/main.php', 'package'
		);
	}

	/**
	 * @internal
	 */
	private function bootMigrations(){
		$this->loadMigrationsFrom(__DIR__ . '/../migrations');
	}

	/**
	 * @internal
	 */
	private function bootMiddleware(){
		$kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
		$kernel->prependMiddleware(Middleware::class);
	}
}