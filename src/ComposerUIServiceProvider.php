<?php namespace ComposerUI\ComposerUI;

use Illuminate\Support\ServiceProvider;

class ComposerUIServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
        public function register()
        {
            $this->package('composer-ui/composer-ui','ComposerUI',__DIR__);
            include 'routes.php';
            include 'filters.php';
        }
}
